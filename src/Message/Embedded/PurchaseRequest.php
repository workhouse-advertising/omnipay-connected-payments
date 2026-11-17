<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Message\Embedded\PurchaseResponse;
use Omnipay\ConnectedPayments\Traits\RequestParameters;

class PurchaseRequest extends AbstractRequest
{
    use RequestParameters;

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency', // TODO: Consider not validating `currency` as it's not actually required.
            'sharedSecret',
            'transactionId',
            'configId',
            'userName',
        );

        // Start with the required data.
        $data = [
            'configId' => $this->getConfigId(),
            'userName' => $this->getUserName(),
            'txnType' => self::TXN_TYPE_PURCHASE,
            'merchReference' => $this->getTransactionId(),
            'amount' => $this->getAmount(), // NOTE: dollars, not cents
            'currency' => $this->getCurrency(),
        ];

        // Filter optional data.
        $optionalData = array_filter([
            'email' => $this->getCard()?->getEmail(), // @phpstan-ignore nullsafe.neverNull
            'channel' => $this->getChannel(),
            'cardToken' => $this->getCardToken(),
            // TODO: Confirm the `tokenControl.token` and `onlyTokenise` parameters accept `0` and `1` as `http_build_query()` would send them.
            'tokenControl.token' => $this->getTokenControlToken(),
            'onlyTokenise' => $this->getOnlyTokenise(),
        ], fn ($item) => (!is_null($item) && $item !== ''));

        // Add metadata.
        $metadata = $this->getMetadata();

        return array_merge($data, $optionalData, $metadata);
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/es-client-frontend/embedded', $this->getBaseEndpoint());
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Embedded\PurchaseResponse::class;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $paramString = http_build_query($data);
        $verifyMessage = hash_hmac('sha256', $paramString, $this->getSharedSecret());
        $iframeUrl = $this->getEndpoint() . "?{$paramString}&verifyMessage={$verifyMessage}";

        return $this->makeResponse([
            'iframeUrl' => $iframeUrl,
        ]);
    }
}

<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Message\Embedded\PurchaseResponse;

class IframeRequest extends AbstractRequest
{
    // TODO: Merge this with the Hosted gateway classes.

    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Consider validation of these fields along with the shared secret.
        return [
            'configId' => $this->getConfigId(),
            'userName' => $this->getUserName(),
            'txnType' => $this->getTxnType(),
            'merchReference' => $this->getTransactionId(),
            // TODO: Is there no field for the currency?
            'amount' => (float) $this->getAmount(), // NOTE: dollars, not cents
        ];
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
        return \Omnipay\ConnectedPayments\Message\Embedded\IframeResponse::class;
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

<?php

namespace Omnipay\ConnectedPayments\Message\Hosted;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Message\Hosted\PurchaseResponse;

class PurchaseRequest extends AbstractRequest
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
            'txnType' => 1, // TODO: Check which values are supported for `txnType` and make this configurable if relevant.
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
        return sprintf('%s/es-client-frontend/hosted', $this->getBaseEndpoint());
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
        return \Omnipay\ConnectedPayments\Message\Hosted\PurchaseResponse::class;
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $paramString = http_build_query($data);
        $verifyMessage = hash_hmac('sha256', $paramString, $this->getSharedSecret());
        $hostedUrl = $this->getEndpoint() . "?{$paramString}&verifyMessage={$verifyMessage}";

        return $this->makeResponse([
            'hostedUrl' => $hostedUrl,
        ]);
    }
}

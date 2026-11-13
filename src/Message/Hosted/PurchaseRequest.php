<?php

namespace Omnipay\ConnectedPayments\Message\Hosted;

use Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest as BasePurchaseRequest;

class PurchaseRequest extends BasePurchaseRequest
{
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
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Hosted\PurchaseResponse::class;
    }
}

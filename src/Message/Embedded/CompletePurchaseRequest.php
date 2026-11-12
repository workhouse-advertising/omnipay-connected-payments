<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest;

class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseResponse::class;
    }
}

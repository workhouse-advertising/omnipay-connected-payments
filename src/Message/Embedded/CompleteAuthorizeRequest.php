<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest;

class CompleteAuthorizeRequest extends CompletePurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Embedded\CompleteAuthorizeResponse::class;
    }
}

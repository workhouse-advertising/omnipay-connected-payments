<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest;

class AuthorizeRequest extends PurchaseRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        return array_merge(parent::getData(), [
            'txnType' => self::TXN_TYPE_PRE_AUTH,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Embedded\AuthorizeResponse::class;
    }
}

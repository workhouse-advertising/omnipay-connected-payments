<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        // TODO: Implement this.
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        // TODO: Implement this.
        return null;
    }
}

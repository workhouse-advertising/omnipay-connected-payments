<?php

namespace Omnipay\ConnectedPayments\Message\Hosted;

use Omnipay\ConnectedPayments\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
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

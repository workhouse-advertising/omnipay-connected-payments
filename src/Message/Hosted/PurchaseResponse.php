<?php

namespace Omnipay\ConnectedPayments\Message\Hosted;

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
    public function isRedirect()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return $this->getHostedUrl();
    }

    /**
     * @return mixed
     */
    public function getHostedUrl()
    {
        return $this->getData()['hostedUrl'] ?? null;
    }
}

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
    public function isRedirect()
    {
        return false;
    }

    /**
     * @return mixed
     */
    public function getIframeUrl()
    {
        return $this->getData()['iframeUrl'] ?? null;
    }
}

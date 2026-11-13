<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
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
     * @return mixed
     */
    public function getIframeUrl()
    {
        return $this->getData()['iframeUrl'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectHtml()
    {
        // TODO: Make width/height/id and other attributes configurable.
        $id = 'connectedpayments-iframe';
        $iframeUrl = $this->getIframeUrl() ?? '';
        $height = '600px';
        $width = '100%';
        return sprintf('<iframe id="%s" src="%s" width="%s" height="%s" frameborder="0" allow="payment"></iframe>', $id, $iframeUrl, $width, $height);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectResponse()
    {
        // $this->validateRedirect();
        return new HttpResponse($this->getRedirectHtml());
    }
}

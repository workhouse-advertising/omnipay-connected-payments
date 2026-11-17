<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected string $iframeId = 'connectedpayments-iframe';

    /**
     * @var string
     */
    protected string $iframeWidth = '100%';

    /**
     * @var string
     */
    protected string $iframeHeight = '600px';

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
     * @inheritDoc
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return $this->getIframeUrl();
    }

    /**
     * @return mixed
     */
    public function getIframeUrl()
    {
        return $this->getData()['iframeUrl'] ?? null;
    }

    /**
     * @return string
     */
    public function getIframeId(): string
    {
        return $this->iframeId;
    }

    /**
     * @param string $iframeId
     * @return static
     */
    public function setIframeId(string $iframeId): static
    {
        $this->iframeId = $iframeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getIframeWidth(): string
    {
        return $this->iframeWidth;
    }

    /**
     * @param string $iframeWidth
     * @return static
     */
    public function setIframeWidth(string $iframeWidth): static
    {
        $this->iframeWidth = $iframeWidth;
        return $this;
    }

    /**
     * @return string
     */
    public function getIframeHeight(): string
    {
        return $this->iframeHeight;
    }

    /**
     * @param string $iframeHeight
     * @return static
     */
    public function setIframeHeight(string $iframeHeight): static
    {
        $this->iframeHeight = $iframeHeight;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectHtml()
    {
        $iframeUrl = $this->getRedirectUrl() ?? '';
        $id = htmlspecialchars($this->getIframeId());
        $width = htmlspecialchars($this->getIframeWidth());
        $height = htmlspecialchars($this->getIframeHeight());
        return sprintf('<iframe id="%s" src="%s" width="%s" height="%s" frameborder="0" allow="payment"></iframe>', $id, $iframeUrl, $width, $height);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectResponse()
    {
        $this->validateRedirect();
        return new HttpResponse($this->getRedirectHtml());
    }
}

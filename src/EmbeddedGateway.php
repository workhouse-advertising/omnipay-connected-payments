<?php

namespace Omnipay\ConnectedPayments;

use Omnipay\ConnectedPayments\AbstractGateway;

class EmbeddedGateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'CBA Connected Payments embedded';
    }

    /**
     * Get an iframe response for rendering the embedded payment form with pre-auth.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\AuthorizeRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\AuthorizeRequest $request */
        return $request;
    }

    /**
     * Check that payment has been completed within the iframe pre-auth.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\CompleteAuthorizeRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\CompleteAuthorizeRequest $request */
        return $request;
    }

    /**
     * Capture payment has been completed within the iframe pre-auth.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\CaptureRequest
     */
    public function capture(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\CaptureRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\CaptureRequest $request */
        return $request;
    }

    /**
     * Get an iframe response for rendering the embedded payment form.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest $request */
        return $request;
    }

    /**
     * Check that payment has been completed within the iframe.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest
     */
    public function completePurchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest $request */
        return $request;
    }
}

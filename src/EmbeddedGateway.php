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
     * Get an iframe response for rendering the embedded payment form.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\IframeRequest
     */
    public function iframe(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Embedded\IframeRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Embedded\IframeRequest $request */
        return $request;
    }

    /**
     * Check that payment has been completed within the iframe.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        // TODO: Consider having this as the iframe response instead and only checking for payment in the `completePurchase()`
        //       method.
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

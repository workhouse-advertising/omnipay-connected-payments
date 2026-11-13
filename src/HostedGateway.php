<?php

namespace Omnipay\ConnectedPayments;

use Omnipay\ConnectedPayments\EmbeddedGateway;

class HostedGateway extends EmbeddedGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'CBA Connected Payments hosted';
    }

    /**
     * Get the redirect response to the hosted gateway.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Hosted\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Hosted\PurchaseRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Hosted\PurchaseRequest $request */
        return $request;
    }

    /**
     * Get an iframe response for rendering the hosted payment form with pre-auth.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Hosted\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Hosted\AuthorizeRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Hosted\AuthorizeRequest $request */
        return $request;
    }
}

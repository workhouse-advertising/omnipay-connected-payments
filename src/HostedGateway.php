<?php

namespace Omnipay\ConnectedPayments;

use Omnipay\ConnectedPayments\AbstractGateway;

class HostedGateway extends AbstractGateway
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
     * Handle return from off-site gateways after purchase.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Hosted\CompletePurchaseRequest
     */
    public function completePurchase(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Hosted\CompletePurchaseRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Hosted\CompletePurchaseRequest $request */
        return $request;
    }
}

<?php

namespace Omnipay\ConnectedPayments;

use Omnipay\Common\AbstractGateway as AbstractGatewayBase;
use Omnipay\ConnectedPayments\Traits\GatewayParameters;

abstract class AbstractGateway extends AbstractGatewayBase
{
    use GatewayParameters;

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'userName' => null,
            'password' => null,
            'configId' => null,
            'sharedSecret' => null,
            'testMode' => false,
        ];
    }

    /**
     * Get notifications.
     *
     * @param array $options
     * @return \Omnipay\ConnectedPayments\Message\Notifications\GetNotificationsRequest
     */
    public function notifications(array $options = [])
    {
        $request = $this->createRequest(\Omnipay\ConnectedPayments\Message\Notifications\GetNotificationsRequest::class, $options);
        /** @var \Omnipay\ConnectedPayments\Message\Notifications\GetNotificationsRequest $request */
        return $request;
    }
}

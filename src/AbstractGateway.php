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
}

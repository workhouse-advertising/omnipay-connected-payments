<?php

namespace Omnipay\ConnectedPayments\Test;

use Omnipay\ConnectedPayments\HostedGateway;
use Omnipay\Tests\GatewayTestCase;

class HostedGatewayTest extends GatewayTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new HostedGateway($this->getHttpClient(), $this->getHttpRequest());
    }
}

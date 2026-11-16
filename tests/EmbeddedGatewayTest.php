<?php

namespace Omnipay\ConnectedPayments\Test;

use Omnipay\ConnectedPayments\EmbeddedGateway;
use Omnipay\Tests\GatewayTestCase;

class EmbeddedGatewayTest extends GatewayTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new EmbeddedGateway($this->getHttpClient(), $this->getHttpRequest());
    }
}

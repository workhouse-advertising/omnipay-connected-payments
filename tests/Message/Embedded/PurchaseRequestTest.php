<?php

namespace Omnipay\ConnectedPayments\Test\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest;
use Omnipay\ConnectedPayments\Test\Message\AbstractMessageTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PurchaseRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\ConnectedPayments\Message\Embedded\PurchaseRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PurchaseRequest($client, $request);

        $this->request->initialize([
            'amount' => 3099.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
        ]);
        $this->request->setUserName('tester.api-user.demo');
        $this->request->setPassword('some-password-but-not-really');
        $this->request->setSharedSecret('some-shared-secret-but-not-really');
        $this->request->setConfigId('e5cd404c-76a1-44ef-9456-a84bfcacaada');
        $this->request->setTransactionId('2c959214-346c-4dd7-a5d5-e0d7fabb76f2');
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'configId' => $this->request->getConfigId(),
            'userName' => $this->request->getUserName(),
            'txnType' => \Omnipay\ConnectedPayments\Message\AbstractRequest::TXN_TYPE_PURCHASE,
            'merchReference' => $this->request->getTransactionId(),
            'amount' => $this->request->getAmount(),
            'currency' => $this->request->getCurrency(),
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        /** @var \Omnipay\Common\Message\AbstractResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $expected = 'https://connectedpayments.commbank.com.au/es-client-frontend/embedded?';
        $this->assertTrue(str_starts_with($response->getRedirectUrl(), $expected), "Redirect URL '{$response->getRedirectUrl()}' does not start with '{$expected}'");
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->expectException(\Omnipay\Common\Exception\InvalidRequestException::class);
        $this->request->setTransactionId(null); // @phpstan-ignore argument.type
        $response = $this->request->send();
    }
}

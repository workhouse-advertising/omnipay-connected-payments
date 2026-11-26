<?php

namespace Omnipay\ConnectedPayments\Test\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest;
use Omnipay\ConnectedPayments\Test\Message\AbstractMessageTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CompletePurchaseRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new CompletePurchaseRequest($client, $request);

        $this->request->initialize([
            'amount' => 3099.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
        ]);
        $this->request->setUserName('tester.api-user.demo');
        $this->request->setPassword('some-password-but-not-really');
        $this->request->setConfigId('e5cd404c-76a1-44ef-9456-a84bfcacaada');
        $this->request->setTransactionId('2c959214-346c-4dd7-a5d5-e0d7fabb76f2');
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'userName' => $this->request->getUserName(),
            'password' => $this->request->getPassword(),
            'startEventTime' => 0,
            'filterCriteria' => [
                'merchantReference' => [
                    'operator' => 'EQ',
                    'value' => $this->request->getTransactionId(),
                ],
            ],
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CompletePurchaseSuccess.txt');

        /** @var \Omnipay\Common\Message\AbstractResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('1794810916W5cQb', $response->getTransactionReference());
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->setMockHttpResponse('CompletePurchaseFailure.txt');

        /** @var \Omnipay\Common\Message\AbstractResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        // TODO: Consider filling in messages from error response codes.
        // $this->assertSame('Some message', $response->getMessage());
    }
}

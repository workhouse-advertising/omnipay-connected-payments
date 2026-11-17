<?php

namespace Omnipay\ConnectedPayments\Test\Message\Embedded;

use Omnipay\ConnectedPayments\Message\Embedded\CaptureRequest;
use Omnipay\ConnectedPayments\Test\Message\AbstractMessageTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse as HttpRedirectResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CaptureRequestTest extends AbstractMessageTestCase
{
    /**
     * @var \Omnipay\ConnectedPayments\Message\Embedded\CaptureRequest
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function setUp() : void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new CaptureRequest($client, $request);

        $this->request->initialize([
            'amount' => 3099.00,
            'currency' => 'AUD',
            'card' => $this->getValidCard(),
        ]);
        $this->request->setUserName('tester.api-user.demo');
        $this->request->setPassword('some-password-but-not-really');
        $this->request->setConfigId('e5cd404c-76a1-44ef-9456-a84bfcacaada');
        $this->request->setTransactionId('2c959214-346c-4dd7-a5d5-e0d7fabb76f2');
        $this->request->setTransactionReference('1794810916W5cQb');
    }

    /**
     * Test the `getData()` method.
     */
    public function testGetData()
    {
        $expected = [
            'userName' => $this->request->getUserName(),
            'password' => $this->request->getPassword(),
            'amount' => $this->request->getAmountInteger(),
            'currency' => $this->request->getCurrency(),
            'merchReference' => $this->request->getTransactionId(),
            'txnId' => $this->request->getTransactionReference(),
            'txnType' => \Omnipay\ConnectedPayments\Message\AbstractRequest::TXN_TYPE_CAPTURE,
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test the `getData()` method when optional fields have been supplied.
     */
    public function testGetDataWithOptionalFields()
    {
        $clientIp = '127.0.0.1';
        $channel = 'Channel fun';
        $gatewaySettingId = 'ABC123';
        $dynamicDescriptor = 'DEF456';
        $allowArbitraryCapture = true;
        $metadata = [
            'beans' => 'OKAY',
            'bunns' => 'FUNN',
            'goose' => 'HAPPY',
        ];
        $this->request->setClientIp($clientIp);
        $this->request->setChannel($channel);
        $this->request->setGatewaySettingId($gatewaySettingId);
        $this->request->setDynamicDescriptor($dynamicDescriptor);
        $this->request->setAllowArbitraryCapture($allowArbitraryCapture);
        $this->request->setMetadata($metadata);

        $expected = [
            'userName' => $this->request->getUserName(),
            'password' => $this->request->getPassword(),
            'amount' => $this->request->getAmountInteger(),
            'currency' => $this->request->getCurrency(),
            'merchReference' => $this->request->getTransactionId(),
            'txnId' => $this->request->getTransactionReference(),
            'txnType' => \Omnipay\ConnectedPayments\Message\AbstractRequest::TXN_TYPE_CAPTURE,
            'channel' => $channel,
            'gatewaySettingId' => $gatewaySettingId,
            'dynamicDescriptor' => $dynamicDescriptor,
            'allowArbitraryCapture' => $allowArbitraryCapture,
            'metadata' => $metadata,
            'requestorIp' => '127.0.0.1',
        ];

        $this->assertEquals($expected, $this->request->getData());
    }

    /**
     * Test a successful request.
     */
    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CaptureSuccess.txt');

        /** @var \Omnipay\Common\Message\AbstractResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('1794810919Wc4bV', $response->getTransactionReference());
    }

    /**
     * Test a failed request.
     */
    public function testSendFailure()
    {
        $this->setMockHttpResponse('CaptureFailure.txt');

        /** @var \Omnipay\Common\Message\AbstractResponse $response */
        $response = $this->request->send();
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('The transaction request is invalid and cannot be processed', $response->getMessage());
    }
}

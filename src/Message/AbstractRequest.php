<?php

namespace Omnipay\ConnectedPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\ConnectedPayments\Traits\GatewayParameters;

abstract class AbstractRequest extends BaseAbstractRequest
{
    use GatewayParameters;

    // Defined transaction types. See https://docs.connectedpayments.cba.com.au/docs/integrations/checkout-integration/embedded-and-hosted-integration-guide
    public const TXN_TYPE_PURCHASE = 1; // Purchase - Standard payment
    public const TXN_TYPE_CAPTURE = 9; // Capture - Capture pre-authorized funds
    public const TXN_TYPE_PRE_AUTH = 10; // Pre-Auth - Hold funds without charging
    public const TXN_TYPE_REFUND = 20; // Refund - Refund against original transaction
    public const TXN_TYPE_OPEN_REFUND = 21; // Open Refund - Refund without original transaction
    public const TXN_TYPE_VOID = 30; // Void - Cancel transaction before settlement
    public const TXN_TYPE_REVERSAL = 39; // Reversal - Reverse a transaction

    /**
     * Get the endpoint to call.
     *
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * Get the method for the endpoint.
     *
     * @return string
     */
    abstract public function getMethod(): string;

    /**
     * Get the FQCN to use for a response.
     *
     * @return string
     */
    abstract public function getResponseClass(): string;

    // TODO: Consider if we want to support overriding `txnType`. Probably not as these are
    //       specific to the request types themselves (authorize, purchase, etc...).
    // /**
    //  * @return int
    //  */
    // public function getTxnType()
    // {
    //     return (int) ($this->getParameter('txnType') ?? self::TXN_TYPE_PURCHASE);
    // }

    // /**
    //  * @param mixed $value
    //  * @return $this
    //  */
    // public function setTxnType($value)
    // {
    //     return $this->setParameter('txnType', $value);
    // }

    /**
     * Create a response from the response data.
     *
     * @return \Omnipay\Common\Message\AbstractResponse
     */
    protected function makeResponse($responseData): AbstractResponse
    {
        $responseClass = $this->getResponseClass();
        return new $responseClass($this, $responseData);
    }

    /**
     * Get the headers to use for authentication.
     *
     * @return array
     */
    protected function getAuthenticationHeaders(): array
    {
        // TODO: Implement authentication.
        // // NOTE: Prioritising the API key if one is set.
        // $header = $this->getApiKey() ? 'x-user-secret-key' : 'x-access-token';
        // $value = $this->getApiKey() ?: $this->getAccessToken();

        return [
            // $header => $value,
        ];
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $headers = array_merge($this->getAuthenticationHeaders(), [
            'Content-Type' => 'application/json',
        ]);

        $requestBody = ($this->getMethod() == 'GET') ? null : json_encode($data);
        $requestParams = ($this->getMethod() == 'GET') ? '?' . http_build_query($data) : '';

        $httpResponse = $this->httpClient->request($this->getMethod(), $this->getEndpoint() . $requestParams, $headers, $requestBody);
        $responseData = json_decode($httpResponse->getBody(), true);

        // TODO: Confirm the status codes used for failed requests and handle them here if necessary.
        // if (($httpResponse->getStatusCode() < 200 || $httpResponse->getStatusCode() > 299) && $httpResponse->getStatusCode() != 400) {
        //     throw new InvalidRequestException("Invalid request to the Connected Payments API. Received status code '{$httpResponse->getStatusCode()}'.");
        // }

        return $this->makeResponse($responseData);
    }
}

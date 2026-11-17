<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Traits\RequestParameters;

class CaptureRequest extends AbstractRequest
{
    use RequestParameters;

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
            'transactionId',
            'transactionReference',
            'userName',
            'password',
        );

        // Start with the required data.
        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            // NOTE: Yes, the amount is in cents which differs from the iframe configuration,
            //       See https://docs.connectedpayments.cba.com.au/docs/api-reference/transaction/capture
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'merchReference' => $this->getTransactionId(),
            'txnId' => $this->getTransactionReference(),
            'txnType' => self::TXN_TYPE_CAPTURE,
        ];

        // Filter optional data.
        $optionalData = array_filter([
            'channel' => $this->getChannel(),
            'gatewaySettingId' => $this->getGatewaySettingId(),
            'dynamicDescriptor' => $this->getDynamicDescriptor(),
            'allowArbitraryCapture' => $this->getAllowArbitraryCapture(),
        ], fn ($item) => (!is_null($item) && $item !== ''));

        // Add metadata.
        $metadata = $this->getMetadata();

        return array_merge($data, $optionalData, $metadata);
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/paymentshub/api/v1/payments/capture', $this->getBaseEndpoint());
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Embedded\CaptureResponse::class;
    }
}

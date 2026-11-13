<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;

class CaptureRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Consider validation of these fields.
        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            // TODO: Is there no field for the currency?
            // NOTE: Yes, the amount is in cents which differs from the iframe configuration,
            //       See https://docs.connectedpayments.cba.com.au/docs/api-reference/transaction/capture
            'amount' => $this->getAmountInteger(),
            'merchReference' => $this->getTransactionId(),
            'txnId' => $this->getTransactionReference(),
            'txnType' => self::TXN_TYPE_CAPTURE,
        ];
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

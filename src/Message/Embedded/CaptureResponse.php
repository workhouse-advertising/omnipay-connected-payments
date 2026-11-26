<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractResponse;

class CaptureResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        $responseCode = $this->getResponseCode();
        return $responseCode && $this->isSuccessResponseCode($responseCode);
    }

    /**
     * @inheritDoc
     */
    public function getResponseCode()
    {
        return $this->getTransaction()['responseCode'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getTransaction()['txnReference'] ?? null;
    }

    /**
     * Get the transaction data.
     *
     * @return array
     */
    public function getTransaction(): array
    {
        return (array) ($this->getData() ?? []);
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        $responseCode = $this->getResponseCode();
        return $responseCode ? $this->getMessageForResponseCode($responseCode) : null;
    }
}

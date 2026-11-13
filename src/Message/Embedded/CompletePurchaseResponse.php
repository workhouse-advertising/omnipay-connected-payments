<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        $responseCode = $this->getTransaction()['responseCode'] ?? null;
        return $responseCode && $this->isSuccessResponseCode($responseCode);
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->getTransaction()['transactionId'] ?? null;
    }

    /**
     * Get the transaction amount in cents.
     *
     * @return int
     */
    public function getTransactionAmount(): int
    {
        return (int) ($this->getTransaction()['amount'] ?? 0);
    }

    /**
     * Get the captured amount in cents.
     *
     * @return int
     */
    public function getTransactionCapturedAmount(): int
    {
        return (int) ($this->getTransaction()['capturedAmount'] ?? 0);
    }

    /**
     * Get the remaining amount to capture in cents.
     *
     * @return int
     */
    public function getTransactionCapturedAmountRemaining(): int
    {
        return (int) ($this->getTransactionAmount() - $this->getTransactionCapturedAmount());
    }

    /**
     * Whether or not the transaction has already been captured.
     *
     * @return bool
     */
    public function alreadyCaptured(): bool
    {
        return $this->getTransactionCapturedAmountRemaining() <= 0;
    }

    /**
     * Whether or not the transaction has already been at least partially captured.
     *
     * @return bool
     */
    public function alreadyPartiallyCaptured(): bool
    {
        return $this->getTransactionCapturedAmount() > 0;
    }

    /**
     * Whether or not the transaction requires capture.
     *
     * @return bool
     */
    public function requiresCapture(): bool
    {
        // TODO: Check and confirm which method we should use for whether or not this transaction
        //       still requires capture or not.
        //       Will we ever have to deal with partial captures at all?
        return !$this->alreadyCaptured();
        // return !$this->alreadyPartiallyCaptured();
    }

    /**
     * Get the returned transactions.
     *
     * @return array
     */
    public function getTransactions(): array
    {
        return (array) ($this->getData()['dynamicQuery']['items'] ?? []);
    }

    /**
     * Get the first matching transaction.
     * TODO: Need to confirm whether or not we can expect only a single transaction to be
     *       returned and consider what we should do if more than one can be returned.
     *       We could simply reject the transaction or could consider filtering to only successful
     *       transactions.
     *
     * @return array
     */
    public function getTransaction(): array
    {
        // TODO: Check and confirm whether or not we could have multiple transactions
        //       returned that contain the exact same `merchantReference` and how we should
        //       go about handling these.
        return (array) ($this->getTransactions()[0] ?? []);
    }
}

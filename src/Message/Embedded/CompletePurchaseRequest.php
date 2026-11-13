<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    // TODO: Merge this with the Hosted gateway classes.

    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Check about validating the transaction ID.
        // $this->validate(
        //     'transactionId',
        // );

        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'filterCriteria' => [
                // TODO: Confirm which fields we can use to filter for transactions.
                'merchantReference' => [
                    'operator' => 'EQ',
                    // TODO: Confirm that the transaction ID is definitely the correct field.
                    'value' => $this->getTransactionId(),
                ],
                // TODO: Should be also be filtering for any other fields?
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/merchanthub/api/v1/dynamicquery/transaction/list', $this->getBaseEndpoint());
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
        // TODO: Need to check against multiple transactions.
        return \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseResponse::class;
    }
}

<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Message\Embedded\PurchaseResponse;

class PurchaseRequest extends AbstractRequest
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
            'filterCriteria' => [
                // TODO: Confirm which fields we can use to filter for transactions.
                'merchReference' => [
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
        return \Omnipay\ConnectedPayments\Message\Embedded\PurchaseResponse::class;
    }
}

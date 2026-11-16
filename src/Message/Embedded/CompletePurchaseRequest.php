<?php

namespace Omnipay\ConnectedPayments\Message\Embedded;

use Omnipay\ConnectedPayments\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'transactionId',
        );

        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'filterCriteria' => [
                'merchantReference' => [
                    'operator' => 'EQ',
                    'value' => $this->getTransactionId(),
                ],
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
        return \Omnipay\ConnectedPayments\Message\Embedded\CompletePurchaseResponse::class;
    }
}

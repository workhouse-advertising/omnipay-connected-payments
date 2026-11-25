<?php

namespace Omnipay\ConnectedPayments\Message\Notifications;

use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Traits\NotificationUpsertRequestParameters;

class UpdateNotificationRequest extends AbstractRequest
{
    use NotificationUpsertRequestParameters;

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'userName',
            'password',
        );

        // Start with the required data.
        $data = [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'enabled' => $this->getEnabled(),
            'maxAttempt' => $this->getMaxAttempt(),
            'payment' => $this->getPayment(),
            'type' => $this->getType(),
        ];

        // Filter optional data.
        $optionalData = array_filter([
            'validUntil' => $this->getValidUntil(),
            'emails' => $this->getEmails(),
            'url' => $this->getUrl(),
            'headers' => $this->getHeaders(),
        ], fn ($item) => (!is_null($item) && $item !== ''));

        return array_merge($data, $optionalData);
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/pfr-notification/v1/management/update', $this->getBaseEndpoint());
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
        return \Omnipay\ConnectedPayments\Message\Notifications\UpdateNotificationResponse::class;
    }
}

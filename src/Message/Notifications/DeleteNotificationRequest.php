<?php

namespace Omnipay\ConnectedPayments\Message\Notifications;

use Omnipay\ConnectedPayments\Message\AbstractRequest;
use Omnipay\ConnectedPayments\Traits\NotificationUpsertRequestParameters;

class DeleteNotificationRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        $this->validate(
            'userName',
            'password',
            'notificationId',
        );

        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'notificationId' => $this->getNotificationId(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/pfr-notification/v1/management/delete', $this->getBaseEndpoint());
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
        return \Omnipay\ConnectedPayments\Message\Notifications\DeleteNotificationResponse::class;
    }

    /**
     * @return mixed
     */
    public function getNotificationId()
    {
        return $this->getParameter('notificationId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setNotificationId($value)
    {
        return $this->setParameter('notificationId', $value);
    }
}

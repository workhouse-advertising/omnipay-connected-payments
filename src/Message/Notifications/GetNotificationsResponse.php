<?php

namespace Omnipay\ConnectedPayments\Message\Notifications;

use Omnipay\ConnectedPayments\Message\AbstractResponse;

class GetNotificationsResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return $this->getResultCode() === '00';
    }

    /**
     * @return string|null
     */
    public function getResultCode()
    {
        return $this->getData()['resultCode'] ?? null;
    }

    /**
     * Get the notifications.
     *
     * @return array
     */
    public function getNotifications()
    {
        return (array) ($this->getData()['notifications'] ?? []);
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        return $this->getData()['message'] ?? null;
    }

    /**
     * @return array|null
     */
    public function getErrors()
    {
        return $this->getData()['errors'] ?? null;
    }
}

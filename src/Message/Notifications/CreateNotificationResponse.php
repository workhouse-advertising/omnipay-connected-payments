<?php

namespace Omnipay\ConnectedPayments\Message\Notifications;

use Omnipay\ConnectedPayments\Message\Notifications\AbstractNotificationsResponse;

class CreateNotificationResponse extends AbstractNotificationsResponse
{
    /**
     * @return bool|null
     */
    public function getEnabled()
    {
        return $this->getData()['enabled'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->getData()['customerId'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getNotificationId()
    {
        return $this->getData()['notificationId'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getValidUntil()
    {
        return $this->getData()['validUntil'] ?? null;
    }
}

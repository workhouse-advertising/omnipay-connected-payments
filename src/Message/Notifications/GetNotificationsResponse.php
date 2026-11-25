<?php

namespace Omnipay\ConnectedPayments\Message\Notifications;

use Omnipay\ConnectedPayments\Message\Notifications\AbstractNotificationsResponse;

class GetNotificationsResponse extends AbstractNotificationsResponse
{
    /**
     * Get the notifications.
     *
     * @return array
     */
    public function getNotifications()
    {
        return (array) ($this->getData()['notifications'] ?? []);
    }
}

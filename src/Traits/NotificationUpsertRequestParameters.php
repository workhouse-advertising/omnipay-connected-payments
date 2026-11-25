<?php

namespace Omnipay\ConnectedPayments\Traits;

trait NotificationUpsertRequestParameters
{
    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->getParameter('enabled');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setEnabled($value)
    {
        return $this->setParameter('enabled', $value);
    }

    /**
     * @return mixed
     */
    public function getMaxAttempt()
    {
        return $this->getParameter('maxAttempt');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setMaxAttempt($value)
    {
        return $this->setParameter('maxAttempt', $value);
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->getParameter('payment');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setPayment($value)
    {
        return $this->setParameter('payment', $value);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    /**
     * @return mixed
     */
    public function getValidUntil()
    {
        return $this->getParameter('validUntil');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValidUntil($value)
    {
        return $this->setParameter('validUntil', $value);
    }

    /**
     * @return mixed
     */
    public function getEmails()
    {
        return $this->getParameter('emails');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setEmails($value)
    {
        return $this->setParameter('emails', $value);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->getParameter('url');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setUrl($value)
    {
        return $this->setParameter('url', $value);
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->getParameter('headers');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setHeaders($value)
    {
        return $this->setParameter('headers', $value);
    }
}

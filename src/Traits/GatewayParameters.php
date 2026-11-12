<?php

namespace Omnipay\ConnectedPayments\Traits;

trait GatewayParameters
{
    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->getParameter('userName');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setUserName($value)
    {
        return $this->setParameter('userName', $value);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return mixed
     */
    public function getConfigId()
    {
        return $this->getParameter('configId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setConfigId($value)
    {
        return $this->setParameter('configId', $value);
    }

    /**
     * @return mixed
     */
    public function getSharedSecret()
    {
        return $this->getParameter('sharedSecret');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setSharedSecret($value)
    {
        return $this->setParameter('sharedSecret', $value);
    }

    /**
     * @return string
     */
    public function getBaseEndpoint()
    {
        return $this->getTestMode() ? $this->getSandboxBaseEndpoint() : $this->getProductionBaseEndpoint();
    }

    /**
     * @return string
     */
    public function getProductionBaseEndpoint()
    {
        return 'https://connectedpayments.commbank.com.au';
    }

    /**
     * @return string
     */
    public function getSandboxBaseEndpoint()
    {
        return 'https://sandbox.connectedpayments.commbank.com.au';
    }
}

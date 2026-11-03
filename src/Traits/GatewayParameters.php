<?php

namespace Omnipay\ConnectedPayments\Traits;

trait GatewayParameters
{
    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

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
}

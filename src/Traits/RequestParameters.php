<?php

namespace Omnipay\ConnectedPayments\Traits;

trait RequestParameters
{
    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    /**
     * @return mixed
     */
    public function getCardToken()
    {
        return $this->getParameter('cardToken');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setCardToken($value)
    {
        return $this->setParameter('cardToken', $value);
    }

    /**
     * @return bool|null
     */
    public function getTokenControlToken()
    {
        $value = $this->getParameter('tokenControlToken');
        return is_null($value) ? $value : (bool) $value;
    }

    /**
     * @param bool|null $value
     * @return $this
     */
    public function setTokenControlToken($value)
    {
        return $this->setParameter('tokenControlToken', $value);
    }

    /**
     * @return bool|null
     */
    public function getOnlyTokenise()
    {
        $value = $this->getParameter('onlyTokenise');
        return is_null($value) ? $value : (bool) $value;
    }

    /**
     * @param bool|null $value
     * @return $this
     */
    public function setOnlyTokenise($value)
    {
        return $this->setParameter('onlyTokenise', $value);
    }

    /**
     * @return bool|null
     */
    public function getAllowArbitraryCapture()
    {
        $value = $this->getParameter('allowArbitraryCapture');
        return is_null($value) ? $value : (bool) $value;
    }

    /**
     * @param bool|null $value
     * @return $this
     */
    public function setAllowArbitraryCapture($value)
    {
        return $this->setParameter('allowArbitraryCapture', $value);
    }

    /**
     * @return mixed
     */
    public function getGatewaySettingId()
    {
        return $this->getParameter('gatewaySettingId');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setGatewaySettingId($value)
    {
        return $this->setParameter('gatewaySettingId', $value);
    }

    /**
     * @return mixed
     */
    public function getDynamicDescriptor()
    {
        return $this->getParameter('dynamicDescriptor');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setDynamicDescriptor($value)
    {
        return $this->setParameter('dynamicDescriptor', $value);
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setMetadata($value)
    {
        $metadata = [];

        // TODO: Consider an `is_iterable($value)` check or if we should just allow errors to be thrown.
        foreach ($value as $key => $metadataValue) {
            $key = preg_replace("/^metadata\./", '', $key);
            $metadata[$key] = $metadataValue;
        }

        return $this->setParameter('metadata', $metadata);
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        $metadata = [];

        $value = $this->getParameter('metadata');
        if (is_iterable($value)) {
            foreach ($value as $key => $metadataValue) {
                $key = 'metadata.' . preg_replace("/^metadata\./", '', $key);
                $metadata[$key] = $metadataValue;
            }
        }

        return $metadata;
    }
}

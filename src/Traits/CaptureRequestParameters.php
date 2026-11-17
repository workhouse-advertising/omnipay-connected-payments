<?php

namespace Omnipay\ConnectedPayments\Traits;

trait CaptureRequestParameters
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
        foreach (($value ?? []) as $key => $metadataValue) {
            // NOTE: Even though stripping the `metadata.` prefix is not required for capture requests
            //       we still do it to keep it consistent with purchase requests.
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
        return (array) $this->getParameter('metadata');
    }
}

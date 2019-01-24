<?php

namespace Worldline\Sips;

/**
 *
 */
abstract class SipsRequest
{
    /**
     *
     * @var string
     */
    public $serviceUrl;

    /**
     *
     * @var string
     */
    protected $interfaceVersion;

    /**
     *
     * @var string
     */
    protected $merchantId;

    /**
     *
     * @var int
     */
    protected $keyVersion;

    /**
     *
     * @var string
     */
    protected $seal;

    /**
     *
     * @var string
     */
    protected $sealAlgorithm;

    /**
     *
     * @return string
     */
    public function getServiceUrl(): string
    {
        return $this->serviceUrl;
    }

    /**
     *
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     *
     * @return int
     */
    public function getKeyVersion(): int
    {
        return $this->keyVersion;
    }

    /**
     * @return string
     */
    public function getInterfaceVersion(): string
    {
        return $this->interfaceVersion;
    }

    /**
     *
     * @return string
     */
    public function getSeal(): string
    {
        return $this->seal;
    }

    /**
     *
     * @return $this
     */
    public function getSealAlgorithm(): string
    {
        return $this->sealAlgorithm;
    }

    /**
     *
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId(string$merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @param string $interfaceVersion
     */
    public function setInterfaceVersion(string $interfaceVersion)
    {
        $this->interfaceVersion = $interfaceVersion;

        return $this;
    }

    /**
     *
     * @param int $keyVersion
     * @return $this
     */
    public function setKeyVersion(int $keyVersion)
    {
        $this->keyVersion = $keyVersion;
        return $this;
    }

    /**
     *
     * @param string $seal
     * @return $this
     */
    public function setSeal(string $seal)
    {
        $this->seal = $seal;
        return $this;
    }

    /**
     *
     * @param string $sealAlgorithm
     * @return $this
     */
    public function setSealAlgorithm(string $sealAlgorithm)
    {
        $this->sealAlgorithm = $sealAlgorithm;
        return $this;
    }

    /**
     *
     * @param string $prefixKey Prefix to add in the beginning of each key
     * @return array
     */
    public function toArray($prefixKey = ''): array
    {
        $array    = [];
        foreach ($this as $key => $value) {
            if (is_null($value) || $key === 'serviceUrl') {
                // null values are excluded from the array export
                continue;
            }
            if ($value instanceof SipsRequest) {
                // Every value in the sub object must be prefixed by the current key
                $array = array_merge($array, $value->toArray($key));
            } else {
                $array[$prefixKey . $key] = $value;
            }
        }
        ksort($array);

        return $array;
    }
}
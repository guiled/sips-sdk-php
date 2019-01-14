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
     * @return array
     */
    abstract protected function toArray(): array;
}
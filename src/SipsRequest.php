<?php

namespace Worldline\Sips;

/**
 *
 */
abstract class SipsRequest extends Common\Field
{
    /**
     * Connecter where to send the request
     * @var string
     */
    public $connecter;

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
    public function getConnecter():string
    {
        return $this->connecter;
    }

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
     * @return array
     */
    public function toArray(): array
    {
        $array    = parent::toArray();
        
        unset($array['serviceUrl']);
        unset($array['connecter']);

        if (isset($array['s10TransactionReference'])) {
            unset($array['transactionReference']);
        }
        ksort($array);

        return $array;
    }
}
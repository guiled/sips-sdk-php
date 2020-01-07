<?php

namespace Worldline\Sips;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Worldline\Sips\Common\Seal\JsonSealCalculator;
use Worldline\Sips\Common\Seal\PostSealCalculator;
use Worldline\Sips\Common\SipsEnvironment;
use Worldline\Sips\Paypage\InitializationResponse;
use Worldline\Sips\SipsRequest;
use Worldline\Sips\Paypage\PaypageResult;

class SipsClient
{
    private $environment;
    private $merchantId;
    private $secretKey;
    private $keyVersion;
    protected $sealAlgorithm;

    /**
     * SipsClient constructor.
     * @param SipsEnvironment $environment
     * @param string $secretKey
     */
    public function __construct(SipsEnvironment $environment, string $merchantId, string $secretKey, int $keyVersion)
    {
        $this->setEnvironment($environment);
        $this->setMerchantId($merchantId);
        $this->setSecretKey($secretKey);
        $this->setKeyVersion($keyVersion);
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @param SipsEnvironment $environment
     */
    public function setEnvironment(SipsEnvironment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param SipsRequest $sipsRequest
     * @return InitializationResponse
     * @throws \Exception
     */
    public function initialize(SipsRequest $sipsRequest): array
    {
        $sipsRequest->setMerchantId($this->getMerchantId());
        $sipsRequest->setKeyVersion($this->getKeyVersion());

        $sealCalculator = new JsonSealCalculator();
        $sealAlgorithm = $this->sealAlgorithm ?? JsonSealCalculator::ALGORITHM_DEFAULT;
        $sealCalculator->calculateSeal($sipsRequest, $this->secretKey, $sealAlgorithm);
        $json = json_encode($sipsRequest->toArray());
        $client = new Client(["base_uri" => $this->environment->getEnvironment($sipsRequest->getConnecter())]);
        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "timeout" => 5,
        ];
        $request = new Request("POST", $sipsRequest->getServiceUrl(), $headers, $json);
        $response = $client->send($request);
        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data['seal'])) {
            
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getMerchantId() : string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId(string $merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return int
     */
    public function getKeyVersion() : int
    {
        return $this->keyVersion;
    }

    /**
     * @param int $keyVersion
     */
    public function setKeyVersion(int $keyVersion)
    {
        $this->keyVersion = $keyVersion;
    }


    public function getSealAlgorithm()
    {
        return $this->sealAlgorithm;
    }

    public function setSealAlgorithm($sealAlgorithm)
    {
        $this->sealAlgorithm = $sealAlgorithm;
        return $this;
    }

    /**
     * @return PaypageResult
     * @throws \Exception
     */
    public function finalizeTransaction(): PaypageResult
    {
        $data = $_POST['Data'];
        $seal = $_POST['Seal'];
        $sealCalculator = new PostSealCalculator();
        if (!$sealCalculator->isCorrectSeal($data, $this->secretKey, $seal)) {
            throw new \Exception("Invalid seal in response. Response not trusted.");
        }
        $paypageResult = new PaypageResult($data);

        return $paypageResult;
    }
}
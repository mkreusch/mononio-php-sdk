<?php

namespace Montonio\Clients;

use Exception;

abstract class AbstractClient
{
    const ENVIRONMENT_SANDBOX = 'sandbox';
    const ENVIRONMENT_LIVE = 'live';
    const ENCODING_ALGORITHM = 'HS256';

    /**
     * @var string
     */
    protected $accessKey;
    /**
     * @var string
     */
    protected $secretKey;
    /**
     * @var string
     */
    protected $environment;

    public function __construct(string $accessKey, string $secretKey, string $environment)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->environment = $environment;
    }

    private function prepareCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        return $ch;
    }

    /**
     * @throws Exception
     */
    protected function call($method, $url, $payload, $headers)
    {
        $ch = $this->prepareCurl($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = $this->execute($ch);
        return json_decode($response, true);
    }

    /**
     * @throws Exception
     */
    private function execute($ch)
    {
        $response = curl_exec($ch);
        if ($response === false) {
            $error_msg = "CURL Request failed: " . curl_error($ch);
            curl_close($ch);
            throw new Exception($error_msg);
        }
        curl_close($ch);
        return $response;
    }



    protected function isSandbox(): bool
    {
        return $this->getEnvironment() === self::ENVIRONMENT_SANDBOX;
    }

    /**
     * @return string
     */
    protected function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @return AbstractClient
     */
    protected function setAccessKey(string $accessKey): AbstractClient
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * @return string
     */
    protected function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @return AbstractClient
     */
    protected function setSecretKey(string $secretKey): AbstractClient
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return string
     */
    protected function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     * @return AbstractClient
     */
    protected function setEnvironment(string $environment): AbstractClient
    {
        $this->environment = $environment;
        return $this;
    }
}
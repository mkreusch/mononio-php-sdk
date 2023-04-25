<?php

namespace Montonio\Clients;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Montonio\Structs\PaymentData;
use stdClass;

class PaymentsClient extends AbstractClient
{
    const SANDBOX_URL = 'https://sandbox-stargate.montonio.com/api';
    const LIVE_URL = 'https://stargate.montonio.com/api';

    /**
     * @param PaymentData $paymentData
     * @return array
     * @throws Exception
     */
    public function createOrder(PaymentData $paymentData): array
    {
        return $this->call(
            'POST',
            $this->getUrl('/orders'),
            json_encode(
                [
                    'data' => $this->generatePaymentToken($paymentData),
                ]
            ),
            [
                'Content-Type: application/json',
            ]
        );
    }

    /**
     * @param PaymentData $paymentData
     * @return string
     */
    public function generatePaymentToken(PaymentData $paymentData): string
    {
        $paymentData->setExp(time() + 600);
        return JWT::encode($paymentData->toArray(), $this->getSecretKey(), static::ENCODING_ALGORITHM);
    }

    /**
     * @param $token
     * @return stdClass
     */
    public function decodePaymentToken($token): stdClass
    {
        JWT::$leeway = 300;
        return JWT::decode($token, new Key($this->getSecretKey(), static::ENCODING_ALGORITHM));
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getUrl(string $path): string
    {
        return ($this->isSandbox() ? self::SANDBOX_URL : self::LIVE_URL) .
            (substr($path, 0, 1) === '/' ? '' : '/') .
            $path;
    }

    /**
     * @return string
     */
    protected function getBearerToken(): string
    {
        return JWT::encode(
            [
                'accessKey' => $this->getAccessKey(),
            ],
            $this->getSecretKey(),
            static::ENCODING_ALGORITHM
        );
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getPaymentMethods()
    {
        $url = $this->getUrl('stores/setup').
            '?access-key=' . $this->getAccessKey();

        return $this->call('GET', $url, null, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->getBearerToken(),
        ]);
    }
}
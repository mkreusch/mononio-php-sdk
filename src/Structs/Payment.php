<?php

namespace Montonio\Structs;

class Payment extends AbstractStruct
{
    public const PAYMENT_METHOD_PAYMENT_INITIATION = 'paymentInitiation';
    public const PAYMENT_METHOD_CARDS = 'cardPayments';

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $methodDisplay;

    /**
     * @var PaymentMethodOptions
     */
    protected $methodOptions;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @return string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Payment
     */
    public function setMethod(string $method): Payment
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethodDisplay(): ?string
    {
        return $this->methodDisplay;
    }

    /**
     * @param string $methodDisplay
     * @return Payment
     */
    public function setMethodDisplay(string $methodDisplay): Payment
    {
        $this->methodDisplay = $methodDisplay;
        return $this;
    }

    /**
     * @return PaymentMethodOptions
     */
    public function getMethodOptions(): ?PaymentMethodOptions
    {
        return $this->methodOptions;
    }

    /**
     * @param PaymentMethodOptions $methodOptions
     * @return Payment
     */
    public function setMethodOptions(PaymentMethodOptions $methodOptions): Payment
    {
        $this->methodOptions = $methodOptions;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Payment
     */
    public function setAmount($amount): Payment
    {
        $this->amount = (float)$amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Payment
     */
    public function setCurrency(string $currency): Payment
    {
        $this->currency = $currency;
        return $this;
    }
}
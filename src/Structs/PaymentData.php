<?php

namespace Montonio\Structs;

class PaymentData extends AbstractStruct
{
    const STATUS_PAID = 'PAID';
    const STATUS_PENDING = 'PENDING';
    /**
     * @var string
     */
    protected $accessKey;

    /**
     * @var string
     */
    protected $merchantReference;

    /**
     * @var string
     */
    protected $returnUrl;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var float
     */
    protected $grandTotal;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var Payment
     */
    protected $payment;

    /**
     * @var int
     */
    protected $exp;

    /**
     * @var LineItem[]
     */
    protected $lineItems = [];

    /**
     * @var Address
     */
    protected $billingAddress;

    /**
     * @var Address
     */
    protected $shippingAddress;
    /**
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @return PaymentData
     */
    public function setAccessKey(string $accessKey): PaymentData
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantReference(): ?string
    {
        return $this->merchantReference;
    }

    /**
     * @param string $merchantReference
     * @return PaymentData
     */
    public function setMerchantReference(string $merchantReference): PaymentData
    {
        $this->merchantReference = $merchantReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     * @return PaymentData
     */
    public function setReturnUrl(string $returnUrl): PaymentData
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotificationUrl(): ?string
    {
        return $this->notificationUrl;
    }

    /**
     * @param string $notificationUrl
     * @return PaymentData
     */
    public function setNotificationUrl(string $notificationUrl): PaymentData
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrandTotal(): ?float
    {
        return $this->grandTotal;
    }

    /**
     * @param float $grandTotal
     * @return PaymentData
     */
    public function setGrandTotal($grandTotal): PaymentData
    {
        $this->grandTotal = (float)$grandTotal;
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
     * @return PaymentData
     */
    public function setCurrency(string $currency): PaymentData
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return PaymentData
     */
    public function setLocale(string $locale): PaymentData
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     * @return PaymentData
     */
    public function setPayment(Payment $payment): PaymentData
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return int
     */
    public function getExp(): ?int
    {
        return $this->exp;
    }

    /**
     * @param int $exp
     * @return PaymentData
     */
    public function setExp($exp): PaymentData
    {
        $this->exp = (int)$exp;
        return $this;
    }

    /**
     * @return LineItem[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param LineItem[] $lineItems
     * @return PaymentData
     */
    public function setLineItems(array $lineItems): PaymentData
    {
        $this->lineItems = $lineItems;
        return $this;
    }

    /**
     * @param LineItem $lineItem
     * @return $this
     */
    public function addLineItem(LineItem $lineItem): PaymentData
    {
        $this->lineItems[] = $lineItem;
        return $this;
    }

    /**
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    /**
     * @param Address $billingAddress
     * @return PaymentData
     */
    public function setBillingAddress(Address $billingAddress): PaymentData
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $shippingAddress
     * @return PaymentData
     */
    public function setShippingAddress(Address $shippingAddress): PaymentData
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }
}
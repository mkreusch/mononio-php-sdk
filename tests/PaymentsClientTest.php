<?php

namespace Montonio\Tests;

use Montonio\Clients\AbstractClient;
use Montonio\Clients\PaymentsClient;
use Montonio\Structs\Address;
use Montonio\Structs\LineItem;
use Montonio\Structs\Payment;
use Montonio\Structs\PaymentData;
use Montonio\Structs\PaymentMethodOptions;
use Montonio\Utils;
use PHPUnit\Framework\TestCase;

class PaymentsClientTest extends TestCase
{

    protected $config = [
        'accessKey' => '0aa12f05-1a2a-4d15-a010-79e3bebed035',
        'secretKey' => 'yIJ5k66+uA5kr7Ya8PfyR6ZL1kpuDbTfIri+smc3C+KP',
    ];

    public function testGetPaymentMethods()
    {
        $paymentsClient = new PaymentsClient($this->config['accessKey'], $this->config['secretKey'], AbstractClient::ENVIRONMENT_SANDBOX);
        $methods = $paymentsClient->getPaymentMethods();
        $this->assertTrue(!empty($methods["paymentMethods"]["paymentInitiation"]["setup"]["DE"]["paymentMethods"]));
    }

    public function testJwt()
    {
        $paymentsClient = new PaymentsClient($this->config['accessKey'], $this->config['secretKey'], AbstractClient::ENVIRONMENT_SANDBOX);
        $token = $paymentsClient->generatePaymentToken((new PaymentData()));
        $this->assertNotEmpty($token);
        $decoded = $paymentsClient->decodePaymentToken($token);
        $this->assertTrue(is_object($decoded) && $decoded->exp > 1000);
    }

    public function testGetPaymentUrl()
    {
        $paymentsClient = new PaymentsClient($this->config['accessKey'], $this->config['secretKey'], AbstractClient::ENVIRONMENT_SANDBOX);

        $paymentData = (new PaymentData())
            ->setAccessKey($this->config['accessKey'])
            ->setMerchantReference(uniqid())
            ->setReturnUrl('https://onlineshop.consulting')
            ->setNotificationUrl('https://onlineshop.consulting')
            ->setCurrency('EUR')
            ->setGrandTotal(10.0)
            ->setLocale(Utils::getNormalizedLocale('en'))
            ->setBillingAddress(
                (new Address())
                    ->setFirstName('John')
                    ->setLastName('Doe')
                    ->setEmail('customer@customer.com')
                    ->setAddressLine1('Kai 1')
                    ->setLocality('Tallinn')
                    ->setRegion('Harjumaa')
                    ->setCountry('EE')
                    ->setPostalCode('10111')
            )
            ->setShippingAddress(
                (new Address())
                    ->setFirstName('John')
                    ->setLastName('Doe')
                    ->setEmail('customer@customer.com')
                    ->setAddressLine1('Kai 1')
                    ->setLocality('Tallinn')
                    ->setRegion('Harjumaa')
                    ->setCountry('EE')
                    ->setPostalCode('10111')
            )
            ->setLineItems([
                (new LineItem())
                    ->setName('Hoverboard')
                    ->setQuantity(1)
                    ->setFinalPrice(10.0),
                (new LineItem())
                    ->setName('Hoverboard 2')
                    ->setQuantity(2)
                    ->setFinalPrice(30.0),
            ])
            ->setPayment(
                (new Payment())
                    ->setMethod(Payment::PAYMENT_METHOD_PAYMENT_INITIATION)
                    ->setCurrency('EUR')
                    ->setAmount(10.0)
                    ->setMethodOptions(
                        (new PaymentMethodOptions())
                            ->setPaymentDescription('Payment for order 123')
                            ->setPaymentReference('reference 123')
                            ->setPreferredCountry('EE')
                            ->setPreferredProvider('LHVBEE22')
                            ->setPreferredLocale(Utils::getNormalizedLocale('en'))
                    )
            );

        $order = $paymentsClient->createOrder($paymentData);
        $this->assertTrue(isset($order['paymentUrl']) && strpos($order['paymentUrl'], 'https://sandbox-stargate') !== false);
    }


}
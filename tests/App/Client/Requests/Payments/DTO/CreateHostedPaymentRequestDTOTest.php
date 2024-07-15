<?php
/**
 * Description of CreateHostedPaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\CreateHostedPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Consts\Order3DSBypass;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CreateHostedPaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CreateHostedPaymentRequestDTO::fromArray([
            'pos_id' => $this->uuid(),
            'mode' => PaymentMode::HOSTED,
            'method' => PaymentMethod::AUTH,
            'amount' => 100.0,
            'currency' => Currency::UAH,
            'description' => $this->uuid(),
            'order_id' => $this->uuid(),
            'server_url' => $this->uuid(),
            'result_url' => $this->uuid(),
            'order_3ds_bypass' => Order3DSBypass::ALWAYS,
            'payload' => $this->uuid(),
            'customer_referrer' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CreateHostedPaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    #[DataProvider('fromArrayDataProvider')]
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CreateHostedPaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT,
                    'method' => PaymentMethod::CAPTURE,
                    'amount' => 200.0,
                    'currency' => Currency::XTS,
                    'description' => 'description',
                    'order_id' => 'order_id',
                    'server_url' => 'server_url',
                    'result_url' => 'result_url',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS,
                    'payload' => 'payload',
                    'customer_referrer' => 'customer_referrer',
                ],
                'expectedData' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT->value,
                    'method' => PaymentMethod::CAPTURE->value,
                    'amount' => 200.0,
                    'currency' => Currency::XTS->value,
                    'description' => 'description',
                    'order_id' => 'order_id',
                    'server_url' => 'server_url',
                    'result_url' => 'result_url',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS->value,
                    'payload' => 'payload',
                    'customer_referrer' => 'customer_referrer',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT,
                    'method' => PaymentMethod::CAPTURE,
                    'amount' => 200.0,
                    'currency' => Currency::XTS,
                    'order_id' => 'order_id',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS,
                ],
                'expectedData' => [
                    'description' => null,
                    'server_url' => null,
                    'result_url' => null,
                    'payload' => null,
                    'customer_referrer' => null,
                ],
            ],
        ];
    }

    #[DataProvider('methodsProvider')]
    public function testMethods(
        string $method,
        array $methodData,
        array $data,
        mixed $expectedResult,
    ): void {
        $dto = CreateHostedPaymentRequestDTO::fromArray($data);
        $result = $dto->$method(...$methodData);
        if (is_array($expectedResult)) {
            $this->assertArraysEqual($expectedResult, $result);

            return;
        }
        $this->assertEquals($expectedResult, $result);
    }

    public static function methodsProvider(): array
    {
        return [
            'Test toRequestData expects currency XTS if test mode' => [
                'method' => 'toRequestData',
                'methodData' => [true],
                'data' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT,
                    'method' => PaymentMethod::CAPTURE,
                    'amount' => 200.0,
                    'currency' => Currency::UAH,
                    'description' => 'description',
                    'order_id' => 'order_id',
                    'server_url' => 'server_url',
                    'result_url' => 'result_url',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS,
                    'payload' => 'payload',
                    'customer_referrer' => 'customer_referrer',
                ],
                'expectedResult' => [
                    'amount' => 200.0,
                    'currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects currency XTS if test mode false but XTS provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT,
                    'method' => PaymentMethod::CAPTURE,
                    'amount' => 200.0,
                    'currency' => Currency::XTS,
                    'description' => 'description',
                    'order_id' => 'order_id',
                    'server_url' => 'server_url',
                    'result_url' => 'result_url',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS,
                    'payload' => 'payload',
                    'customer_referrer' => 'customer_referrer',
                ],
                'expectedResult' => [
                    'amount' => 200.0,
                    'currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects currency UAH if test mode false and UAH provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'posId',
                    'mode' => PaymentMode::DIRECT,
                    'method' => PaymentMethod::CAPTURE,
                    'amount' => 200.0,
                    'currency' => Currency::UAH,
                    'description' => 'description',
                    'order_id' => 'order_id',
                    'server_url' => 'server_url',
                    'result_url' => 'result_url',
                    'order_3ds_bypass' => Order3DSBypass::ALWAYS,
                    'payload' => 'payload',
                    'customer_referrer' => 'customer_referrer',
                ],
                'expectedResult' => [
                    'amount' => 200.0,
                    'currency' => Currency::UAH->value,
                ],
            ],
        ];
    }
}

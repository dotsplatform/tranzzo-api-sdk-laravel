<?php
/**
 * Description of SplitCapturePaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\SplitCapturePaymentRequestDTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Split\SplitMerchants;
use Tests\TestCase;

class SplitCapturePaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = SplitCapturePaymentRequestDTO::fromArray([
            'pos_id' => $this->uuid(),
            'order_id' => $this->uuid(),
            'charge_amount' => 100.0,
            'currency' => Currency::UAH,
            'comment' => $this->uuid(),
            'server_url' => $this->uuid(),
            'split' => SplitMerchants::fromArray([
                [
                    'sub_merchant_id' => $this->uuid(),
                    'amount' => 100.0,
                ],
            ]),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            SplitCapturePaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = SplitCapturePaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'charge_amount' => 100.0,
                    'currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                    'split' => SplitMerchants::fromArray([
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ]),
                ],
                'expectedData' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'charge_amount' => 100.0,
                    'currency' => Currency::UAH->value,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                    'split' => [
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ],
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'split' => SplitMerchants::fromArray([
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ]),
                ],
                'expectedData' => [
                    'charge_amount' => null,
                    'currency' => null,
                    'comment' => null,
                    'server_url' => null,
                ],
            ],
        ];
    }

    /**
     * @dataProvider methodsProvider
     */
    public function testMethods(
        string $method,
        array $methodData,
        array $data,
        mixed $expectedResult,
    ): void {
        $dto = SplitCapturePaymentRequestDTO::fromArray($data);
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
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'charge_amount' => 200.0,
                    'currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                    'split' => SplitMerchants::fromArray([
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ]),
                ],
                'expectedResult' => [
                    'charge_amount' => 200.0,
                    'currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects currency XTS if test mode false but XTS provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'charge_amount' => 200.0,
                    'currency' => Currency::XTS,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                    'split' => SplitMerchants::fromArray([
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ]),
                ],
                'expectedResult' => [
                    'charge_amount' => 200.0,
                    'currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects currency UAH if test mode false and UAH provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'charge_amount' => 200.0,
                    'currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                    'split' => SplitMerchants::fromArray([
                        [
                            'sub_merchant_id' => 'sub_merchant_id',
                            'amount' => 100.0,
                        ],
                    ]),
                ],
                'expectedResult' => [
                    'charge_amount' => 200.0,
                    'currency' => Currency::UAH->value,
                ],
            ],
        ];
    }
}

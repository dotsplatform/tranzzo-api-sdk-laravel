<?php
/**
 * Description of OperationTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentStatus;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Dots\Tranzzo\App\Client\Resources\TranzzoDateTime;
use Tests\TestCase;

class OperationTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Operation::fromArray([
            'operation_id' => $this->uuid(),
            'payment_id' => $this->uuid(),
            'order_id' => $this->uuid(),
            'transaction_id' => $this->uuid(),
            'pos_id' => $this->uuid(),
            'mode' => PaymentMode::HOSTED,
            'method' => PaymentMethod::AUTH,
            'amount' => 100.0,
            'currency' => Currency::UAH,
            'status' => PaymentStatus::SUCCESS,
            'status_code' => $this->uuid(),
            'status_description' => $this->uuid(),
            'created_at' => TranzzoDateTime::fromTimestamp(time())->__toString(),
            'processing_time' => $this->uuid(),
            'comment' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Operation::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Operation::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'operation_id' => 'operation_id',
                    'payment_id' => 'payment_id',
                    'order_id' => 'order_id',
                    'transaction_id' => 'transaction_id',
                    'pos_id' => 'pos_id',
                    'mode' => PaymentMode::HOSTED,
                    'method' => PaymentMethod::AUTH,
                    'amount' => 100.0,
                    'currency' => Currency::UAH,
                    'status' => PaymentStatus::SUCCESS,
                    'status_code' => 'status_code',
                    'status_description' => 'status_description',
                    'created_at' => TranzzoDateTime::fromTimestamp(time()),
                    'processing_time' => 'processing_time',
                    'comment' => 'comment',
                ],
                'expectedData' => [
                    'operation_id' => 'operation_id',
                    'payment_id' => 'payment_id',
                    'order_id' => 'order_id',
                    'transaction_id' => 'transaction_id',
                    'pos_id' => 'pos_id',
                    'mode' => PaymentMode::HOSTED->value,
                    'method' => PaymentMethod::AUTH->value,
                    'amount' => 100.0,
                    'currency' => Currency::UAH->value,
                    'status' => PaymentStatus::SUCCESS->value,
                    'status_code' => 'status_code',
                    'status_description' => 'status_description',
                    'created_at' => TranzzoDateTime::fromTimestamp(time())->__toString(),
                    'processing_time' => 'processing_time',
                    'comment' => 'comment',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'payment_id' => 'payment_id',
                    'order_id' => 'order_id',
                    'transaction_id' => 'transaction_id',
                    'pos_id' => 'pos_id',
                    'mode' => PaymentMode::HOSTED,
                    'method' => PaymentMethod::AUTH,
                    'amount' => 100.0,
                    'currency' => Currency::UAH,
                    'status' => PaymentStatus::SUCCESS,
                    'status_code' => 'status_code',
                    'status_description' => 'status_description',
                    'created_at' => TranzzoDateTime::fromTimestamp(time()),
                ],
                'expectedData' => [
                    'operation_id' => null,
                    'processing_time' => null,
                    'comment' => null,
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
        $dto = Operation::fromArray($data);
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
            'Test isOnHold expects false if method not auth' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::CAPTURE,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if method is auth but status is init' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::INIT,
                ]),
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if method is auth but status is pending' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::PENDING,
                ]),
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if method is auth but status is failure' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::FAILURE,
                ]),
                'expectedResult' => false,
            ],

            'Test isOnHold expects true' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => true,
            ],

            // capture

            'Test isCaptured expects false if method not capture' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if method is capture but status is init' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::CAPTURE,
                    'status' => PaymentStatus::INIT,
                ]),
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if method is capture but status is pending' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::CAPTURE,
                    'status' => PaymentStatus::PENDING,
                ]),
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if method is capture but status is failure' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::CAPTURE,
                    'status' => PaymentStatus::FAILURE,
                ]),
                'expectedResult' => false,
            ],

            'Test isCaptured expects true' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::CAPTURE,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => true,
            ],

            // void

            'Test isVoided expects false if method not void' => [
                'method' => 'isVoided',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::AUTH,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => false,
            ],

            'Test isVoided expects false if method is void but status is init' => [
                'method' => 'isVoided',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::VOID,
                    'status' => PaymentStatus::INIT,
                ]),
                'expectedResult' => false,
            ],

            'Test isVoided expects false if method is void but status is pending' => [
                'method' => 'isVoided',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::VOID,
                    'status' => PaymentStatus::PENDING,
                ]),
                'expectedResult' => false,
            ],

            'Test isVoided expects false if method is void but status is failure' => [
                'method' => 'isVoided',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::VOID,
                    'status' => PaymentStatus::FAILURE,
                ]),
                'expectedResult' => false,
            ],

            'Test isVoided expects true' => [
                'method' => 'isVoided',
                'methodData' => [],
                'data' => self::generateBaseOperationData([
                    'method' => PaymentMethod::VOID,
                    'status' => PaymentStatus::SUCCESS,
                ]),
                'expectedResult' => true,
            ],
        ];
    }

    private static function generateBaseOperationData(array $data): array
    {
        return array_merge([
            'operation_id' => 'operation_id',
            'payment_id' => 'payment_id',
            'order_id' => 'order_id',
            'transaction_id' => 'transaction_id',
            'pos_id' => 'pos_id',
            'mode' => PaymentMode::HOSTED,
            'method' => PaymentMethod::AUTH,
            'amount' => 100.0,
            'currency' => Currency::UAH,
            'status' => PaymentStatus::SUCCESS,
            'status_code' => 'status_code',
            'status_description' => 'status_description',
            'created_at' => TranzzoDateTime::fromTimestamp(time()),
            'processing_time' => 'processing_time',
            'comment' => 'comment',
        ], $data);
    }
}

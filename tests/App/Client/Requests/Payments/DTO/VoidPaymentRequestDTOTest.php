<?php
/**
 * Description of VoidPaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\VoidPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Tests\TestCase;

class VoidPaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = VoidPaymentRequestDTO::fromArray([
            'pos_id' => $this->uuid(),
            'order_id' => $this->uuid(),
            'order_currency' => Currency::UAH,
            'comment' => $this->uuid(),
            'server_url' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            VoidPaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = VoidPaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'order_currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                ],
                'expectedData' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'order_currency' => Currency::UAH->value,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                ],
                'expectedData' => [
                    'order_currency' => null,
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
        $dto = VoidPaymentRequestDTO::fromArray($data);
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
            'Test toRequestData expects order_currency XTS if test mode' => [
                'method' => 'toRequestData',
                'methodData' => [true],
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'order_currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                ],
                'expectedResult' => [
                    'order_currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects order_currency XTS if test mode false but XTS provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'order_currency' => Currency::XTS,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                ],
                'expectedResult' => [
                    'order_currency' => Currency::XTS->value,
                ],
            ],
            'Test toRequestData expects order_currency UAH if test mode false and UAH provided' => [
                'method' => 'toRequestData',
                'methodData' => [false],
                'data' => [
                    'pos_id' => 'pos_id',
                    'order_id' => 'order_id',
                    'order_currency' => Currency::UAH,
                    'comment' => 'comment',
                    'server_url' => 'server_url',
                ],
                'expectedResult' => [
                    'order_currency' => Currency::UAH->value,
                ],
            ],
        ];
    }
}

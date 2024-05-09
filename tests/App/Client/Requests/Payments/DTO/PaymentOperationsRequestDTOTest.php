<?php
/**
 * Description of PaymentOperationsRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\PaymentOperationsRequestDTO;
use Tests\TestCase;

class PaymentOperationsRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PaymentOperationsRequestDTO::fromArray([
            'posId' => $this->uuid(),
            'orderId' =>$this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            PaymentOperationsRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = PaymentOperationsRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'posId' => 'posId',
                    'orderId' =>  'orderId',
                ],
                'expectedData' => [
                    'posId' => 'posId',
                    'orderId' =>  'orderId',
                ],
            ],
        ];
    }
}

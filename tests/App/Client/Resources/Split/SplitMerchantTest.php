<?php
/**
 * Description of SplitMerchantTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources\Split;

use Dots\Tranzzo\App\Client\Resources\Split\SplitMerchant;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SplitMerchantTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = SplitMerchant::fromArray([
            'sub_merchant_id' => $this->uuid(),
            'amount' => 100.5,
        ]);

        $this->assertEquals(
            $dto->toArray(),
            SplitMerchant::fromArray($dto->toArray())->toArray(),
        );
    }

    #[DataProvider('fromArrayDataProvider')]
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = SplitMerchant::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'sub_merchant_id' => 'sub_merchant_id',
                    'amount' => 100.5,
                ],
                'expectedData' => [
                    'sub_merchant_id' => 'sub_merchant_id',
                    'amount' => 100.5,
                ],
            ],
        ];
    }
}

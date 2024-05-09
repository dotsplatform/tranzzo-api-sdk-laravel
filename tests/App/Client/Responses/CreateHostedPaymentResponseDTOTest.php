<?php
/**
 * Description of CreateHostedPaymentResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Responses;

use Dots\Tranzzo\App\Client\Responses\CreateHostedPaymentResponseDTO;
use Tests\TestCase;

class CreateHostedPaymentResponseDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CreateHostedPaymentResponseDTO::fromArray([
            'url' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CreateHostedPaymentResponseDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CreateHostedPaymentResponseDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'url' => 'url',
                ],
                'expectedData' => [
                    'url' => 'url',
                ],
            ],
        ];
    }
}

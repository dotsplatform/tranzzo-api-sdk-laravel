<?php
/**
 * Description of TranzzoAuthDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Auth\DTO;

use Dots\Tranzzo\App\Client\Auth\DTO\TranzzoAuthDTO;
use Tests\TestCase;

class TranzzoAuthDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = TranzzoAuthDTO::fromArray([
            'posId' => $this->uuid(),
            'apiKey' => $this->uuid(),
            'apiSecret' => $this->uuid(),
            'endpointKey' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            TranzzoAuthDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = TranzzoAuthDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'posId' => 'posId',
                    'apiKey' => 'apiKey',
                    'apiSecret' => 'apiSecret',
                    'endpointKey' => 'endpointKey',
                ],
                'expectedData' => [
                    'posId' => 'posId',
                    'apiKey' => 'apiKey',
                    'apiSecret' => 'apiSecret',
                    'endpointKey' => 'endpointKey',
                ],
            ],
        ];
    }
}

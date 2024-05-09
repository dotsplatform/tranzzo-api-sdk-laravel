<?php
/**
 * Description of ErrorResponseDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Responses;

use Dots\Tranzzo\App\Client\Responses\ErrorResponseDTO;
use Tests\TestCase;

class ErrorResponseDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ErrorResponseDTO::fromArray([
            'message' => $this->uuid(),
            'args' => [],
            'details' => [],
            'code' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ErrorResponseDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ErrorResponseDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'message' => 'message',
                    'args' => [
                        'reason' => 'reason',
                    ],
                    'details' => [
                        'detail' => 'detail',
                    ],
                    'code' => 'code',
                ],
                'expectedData' => [
                    'message' => 'message',
                    'args' => [
                        'reason' => 'reason',
                    ],
                    'details' => [
                        'detail' => 'detail',
                    ],
                    'code' => 'code',
                ],
            ],

            'Test expects null by default' => [
                'data' => [
                    'message' => 'message',
                ],
                'expectedData' => [
                    'args' => null,
                    'details' => null,
                    'code' => null,
                ],
            ],
        ];
    }
}

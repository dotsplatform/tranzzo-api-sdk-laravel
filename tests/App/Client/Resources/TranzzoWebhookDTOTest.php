<?php
/**
 * Description of TranzzoWebhookDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use Dots\Tranzzo\App\Client\Resources\TranzzoWebhookDTO;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TranzzoWebhookDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = TranzzoWebhookDTO::fromArray([
            'signature' => $this->uuid(),
            'data' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            TranzzoWebhookDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    #[DataProvider('fromArrayDataProvider')]
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = TranzzoWebhookDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'signature' => 'signature',
                    'data' => 'data',
                ],
                'expectedData' => [
                    'signature' => 'signature',
                    'data' => 'data',
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
        $dto = TranzzoWebhookDTO::fromArray($data);
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
            'Test getDecodedData expects data' => [
                'method' => 'getDecodedData',
                'methodData' => [],
                'data' => [
                    'signature' => 'signature',
                    'data' => 'eyJrZXkiOiAidmFsdWUifQ',
                ],
                'expectedResult' => [
                    'key' => 'value',
                ],
            ],

            'Test getDecodedData expects empty array if invalid encodedData' => [
                'method' => 'getDecodedData',
                'methodData' => [],
                'data' => [
                    'signature' => 'signature',
                    'data' => 'asdfaslkjdflkasjdlf',
                ],
                'expectedResult' => [],
            ],
        ];
    }
}

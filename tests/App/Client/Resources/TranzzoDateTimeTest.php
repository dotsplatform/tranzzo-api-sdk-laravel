<?php
/**
 * Description of TranzzoDateTimeTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Resources;

use DateTime;
use Dots\Tranzzo\App\Client\Resources\TranzzoDateTime;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TranzzoDateTimeTest extends TestCase
{
    public static function getProvideTranzzoDateTimeTestData(): array
    {
        return [
            'valid datetime string' => [
                '2023-05-13T13:21:22Z',
                '2023-05-13T13:21:22+00:00',
                (new DateTime('2023-05-13T13:21:22Z'))->getTimestamp(),
            ],
        ];
    }

    public static function getProvideTranzzoDateTimeFromTimestampTestData(): array
    {
        return [
            'valid timestamp' => [
                1704067200, // 2023-01-01T00:00:00Z
                '2024-01-01T00:00:00+00:00',
            ],
        ];
    }

    #[DataProvider('getProvideTranzzoDateTimeTestData')]
    public function testTranzzoDateTime(string $inputDate, string $expectedDateString, int $expectedTimestamp): void
    {
        $tranzzoDateTime = TranzzoDateTime::fromString($inputDate);

        $this->assertEquals($expectedDateString, $tranzzoDateTime->__toString());
        $this->assertEquals($expectedTimestamp, $tranzzoDateTime->getTimestamp());
    }

    #[DataProvider('getProvideTranzzoDateTimeFromTimestampTestData')]
    public function testTranzzoDateTimeFromTimestamp(int $timestamp, string $expectedDateString): void
    {
        $tranzzoDateTime = TranzzoDateTime::fromTimestamp($timestamp);

        $this->assertEquals($expectedDateString, $tranzzoDateTime->__toString());
    }
}

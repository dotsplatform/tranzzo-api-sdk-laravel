<?php
/**
 * Description of ResendPaymentWebhookRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Requests\Payments\DTO;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\ResendPaymentWebhookRequestDTO;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ResendPaymentWebhookRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ResendPaymentWebhookRequestDTO::fromArray([
            'posId' => $this->uuid(),
            'orderId' => $this->uuid(),
            'transactionId' => $this->uuid(),
            'callback' => true,
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ResendPaymentWebhookRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    #[DataProvider('fromArrayDataProvider')]
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ResendPaymentWebhookRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'posId' => 'posId',
                    'orderId' => 'orderId',
                    'transactionId' => 'transactionId',
                    'callback' => true,
                ],
                'expectedData' => [
                    'posId' => 'posId',
                    'orderId' => 'orderId',
                    'transactionId' => 'transactionId',
                    'callback' => true,
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'posId' => 'posId',
                    'orderId' => 'orderId',
                    'callback' => true,
                ],
                'expectedData' => [
                    'transactionId' => null,
                ],
            ],
        ];
    }
}

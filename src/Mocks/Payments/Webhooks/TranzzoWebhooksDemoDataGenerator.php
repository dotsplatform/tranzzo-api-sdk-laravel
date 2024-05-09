<?php
/**
 * Description of TranzzoWebhooksDemoDataGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\Mocks\Payments\Webhooks;

use Dots\Tranzzo\App\Client\Resources\TranzzoWebhookDTO;
use Dots\Tranzzo\Mocks\Payments\Generators\TranzzoResponseDemoDataGenerator;
use Ramsey\Uuid\Uuid;

class TranzzoWebhooksDemoDataGenerator
{
    public static function generateHold(array $data = []): TranzzoWebhookDTO
    {
        $operation = TranzzoResponseDemoDataGenerator::generateHold($data);

        return self::generateWebhook($operation->toArray());
    }

    public static function generateCapture(array $data = []): TranzzoWebhookDTO
    {
        $operation = TranzzoResponseDemoDataGenerator::generateCapture($data);

        return self::generateWebhook($operation->toArray());
    }

    public static function generateVoid(array $data = []): TranzzoWebhookDTO
    {
        $operation = TranzzoResponseDemoDataGenerator::generateVoid($data);

        return self::generateWebhook($operation->toArray());
    }

    public static function generateWebhook(array $webhookData, ?string $signature = null): TranzzoWebhookDTO
    {
        $data = strtr(base64_encode(json_encode($webhookData)), '+/', '-_');

        return TranzzoWebhookDTO::fromArray([
            'signature' => $signature ?? Uuid::uuid7()->toString(),
            'data' => $data,
        ]);
    }
}

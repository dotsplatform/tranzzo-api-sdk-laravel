<?php
/**
 * Description of TranzzoOperationGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\Mocks\Payments\Generators;

use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentStatus;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Dots\Tranzzo\App\Client\Resources\Operations;
use Dots\Tranzzo\App\Client\Resources\TranzzoDateTime;
use Dots\Tranzzo\App\Client\Responses\CreateHostedPaymentResponseDTO;

class TranzzoResponseDemoDataGenerator
{
    public static function generateBadRequestResponse(array $data = []): array
    {
        return array_merge([
            'message' => 'Invalid amount provided',
            'args' => [
                [
                    'field_name' => 'amount',
                    'violation' => 'Invalid value for amount: must be a Number in range of [500 - 100000] INR, actual - 300',
                ],
            ],
        ], $data);
    }

    public static function generateSuccessCreatePaymentResponse(array $data = []): CreateHostedPaymentResponseDTO
    {
        return CreateHostedPaymentResponseDTO::fromArray(array_merge([
            'url' => 'https://blackhole.com',
        ], $data));
    }

    public static function generateOperations(array $lastOperationData = []): Operations
    {
        $operations = [
            self::generateHold(),
            self::generateCapture(),
            self::generateVoid(),
        ];

        if (! empty($lastOperationData)) {
            $operations[] = self::generateOperation($lastOperationData);
        }

        return Operations::fromArray([
            'operations' => $operations,
        ]);
    }

    public static function generateHold(array $data = []): Operation
    {
        return self::generateOperation(array_merge([
            'method' => PaymentMethod::AUTH,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generateCapture(array $data = []): Operation
    {
        return self::generateOperation(array_merge([
            'method' => PaymentMethod::CAPTURE,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generateVoid(array $data = []): Operation
    {
        return self::generateOperation(array_merge([
            'method' => PaymentMethod::CAPTURE,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generateOperation(array $data = []): Operation
    {
        return Operation::fromArray(array_merge([
            'operation_id' => 'operation_id',
            'payment_id' => 'payment_id',
            'order_id' => 'order_id',
            'transaction_id' => 'transaction_id',
            'pos_id' => 'pos_id',
            'mode' => PaymentMode::HOSTED,
            'method' => PaymentMethod::AUTH,
            'amount' => 100.0,
            'currency' => Currency::UAH,
            'status' => PaymentStatus::SUCCESS,
            'status_code' => 'status_code',
            'status_description' => 'status_description',
            'created_at' => TranzzoDateTime::fromTimestamp(time()),
            'processing_time' => 'processing_time',
            'fee' => 100,
            'comment' => 'comment',
        ], $data));
    }
}

<?php
/**
 * Description of TranzzoPaymentsResponseMocker.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\Mocks\Payments;

use Dots\Tranzzo\App\Client\Requests\Payments\CreateHostedPaymentRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\PaymentOperationsRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\ResendPaymentWebhookRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\SplitCapturePaymentRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\VoidPaymentRequest;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Dots\Tranzzo\App\Client\Resources\Operations;
use Dots\Tranzzo\App\Client\Responses\CreateHostedPaymentResponseDTO;
use Dots\Tranzzo\Mocks\Payments\Generators\TranzzoResponseDemoDataGenerator;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

class TranzzoPaymentsResponseMocker
{
    public static function mockSuccessCreatePayment(array $data = []): CreateHostedPaymentResponseDTO
    {
        $dto = TranzzoResponseDemoDataGenerator::generateSuccessCreatePaymentResponse($data);
        $headers = [
            'location' => $dto->getUrl(),
        ];
        MockClient::global([
            CreateHostedPaymentRequest::class => MockResponse::make([], 302, $headers),
        ]);

        return $dto;
    }

    public static function mockSuccessPaymentOperations(array $data = []): Operations
    {
        $dto = TranzzoResponseDemoDataGenerator::generateOperations($data);
        MockClient::global([
            PaymentOperationsRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessResendPaymentWebhook(): void
    {
        MockClient::global([
            ResendPaymentWebhookRequest::class => MockResponse::make(),
        ]);
    }

    public static function mockSuccessSplitCapture(array $data = []): Operation
    {
        $dto = TranzzoResponseDemoDataGenerator::generateCapture($data);
        MockClient::global([
            SplitCapturePaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessVoid(array $data = []): Operation
    {
        $dto = TranzzoResponseDemoDataGenerator::generateVoid($data);
        MockClient::global([
            VoidPaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockFailCreatePayment(array $data = []): array
    {
        $data = TranzzoResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            CreateHostedPaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailSplitCapturePayment(array $data = []): array
    {
        $data = TranzzoResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            SplitCapturePaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailVoidPayment(array $data = []): array
    {
        $data = TranzzoResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            VoidPaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }
}

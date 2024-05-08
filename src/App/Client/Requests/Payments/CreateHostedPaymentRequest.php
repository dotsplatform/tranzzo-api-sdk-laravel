<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\CreateHostedPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\PostTranzzoRequest;
use Dots\Tranzzo\App\Client\Responses\CreateHostedPaymentResponseDTO;
use Saloon\Http\Response;

class CreateHostedPaymentRequest extends PostTranzzoRequest
{
    public const ENDPOINT = '/api/v1/payment';

    public function __construct(
        private readonly CreateHostedPaymentRequestDTO $dto,
        private readonly bool $testMode,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->dto->toRequestData($this->testMode);
    }

    public function resolveEndpoint(): string
    {
        return self::ENDPOINT;
    }

    protected function defaultConfig(): array
    {
        return [
            'allow_redirects' => false,
        ];
    }

    public function createDtoFromResponse(Response $response): CreateHostedPaymentResponseDTO
    {
        return CreateHostedPaymentResponseDTO::fromResponse($response);
    }
}

<?php
/**
 * Description of ConfirmPaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\SplitCapturePaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\PostTranzzoRequest;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Saloon\Http\Response;

class SplitCapturePaymentRequest extends PostTranzzoRequest
{
    public const ENDPOINT = '/api/v1/split/capture';

    public function __construct(
        private readonly SplitCapturePaymentRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): Operation
    {
        return Operation::fromArray($response->json());
    }
}

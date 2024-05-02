<?php
/**
 * Description of RefundPaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments;

use Dots\Tranzzo\App\Client\Requests\Payments\DTO\VoidPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\PostTranzzoRequest;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Saloon\Http\Response;

class VoidPaymentRequest extends PostTranzzoRequest
{
    public const ENDPOINT = '/api/v1/void';

    public function __construct(
        private readonly VoidPaymentRequestDTO $dto,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->dto->toArray();
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

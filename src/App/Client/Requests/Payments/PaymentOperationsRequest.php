<?php
/**
 * Description of PaymentOperationsRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments;

use Dots\Tranzzo\App\Client\Requests\BaseTranzzoRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\PaymentOperationsRequestDTO;
use Dots\Tranzzo\App\Client\Resources\Operations;
use Saloon\Http\Response;

class PaymentOperationsRequest extends BaseTranzzoRequest
{
    public const ENDPOINT = '/api/v1/pos/%s/orders/%s';

    public function __construct(
        private readonly PaymentOperationsRequestDTO $dto,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return sprintf(
            self::ENDPOINT,
            $this->dto->getPosId(),
            $this->dto->getOrderId(),
        );
    }

    public function createDtoFromResponse(Response $response): Operations
    {
        return Operations::fromArray($response->json());
    }
}

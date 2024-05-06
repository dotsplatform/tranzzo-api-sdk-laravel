<?php
/**
 * Description of ResendPaymentWebhookRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments;

use Dots\Tranzzo\App\Client\Requests\BaseTranzzoRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\ResendPaymentWebhookRequestDTO;

class ResendPaymentWebhookRequest extends BaseTranzzoRequest
{
    public const ENDPOINT = '/api/v1/pos/%s/orders/%s/purchase';

    public function __construct(
        private readonly ResendPaymentWebhookRequestDTO $dto,
    ) {
    }

    protected function defaultQuery(): array
    {
        return [
            'transactionId' => $this->dto->getTransactionId(),
            'callback' => $this->dto->isCallback(),
        ];
    }

    public function resolveEndpoint(): string
    {
        return sprintf(
            self::ENDPOINT,
            $this->dto->getPosId(),
            $this->dto->getOrderId(),
        );
    }
}

<?php
/**
 * Description of ResendPaymentWebhookRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;

class ResendPaymentWebhookRequestDTO extends DTO
{
    protected string $posId;

    protected string $orderId;

    protected ?string $transactionId;

    protected bool $callback = true;

    public function getPosId(): string
    {
        return $this->posId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function isCallback(): bool
    {
        return $this->callback;
    }
}

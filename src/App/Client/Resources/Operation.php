<?php
/**
 * Description of Transaction.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources;

use Dots\Data\Entity;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentStatus;

class Operation extends Entity
{
    protected ?string $operation_id;

    protected string $payment_id;

    protected string $order_id;

    protected string $transaction_id;

    protected string $pos_id;

    protected PaymentMode $mode;

    protected PaymentMethod $method;

    protected int $amount;

    protected Currency $currency;

    protected PaymentStatus $status;

    protected string $status_code;

    protected string $status_description;

    protected TranzzoDateTime $created_at;

    protected string $processing_time;

    protected ?int $fee;

    protected ?string $comment;

    public static function fromArray(array $data): static
    {
        $data['created_at'] = TranzzoDateTime::fromString($data['created_at']);

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['created_at'] = $this->getCreatedAt()->__toString();

        return $data;
    }

    public function getOperationId(): ?string
    {
        return $this->operation_id;
    }

    public function getPaymentId(): string
    {
        return $this->payment_id;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    public function getPosId(): string
    {
        return $this->pos_id;
    }

    public function getMode(): PaymentMode
    {
        return $this->mode;
    }

    public function getMethod(): PaymentMethod
    {
        return $this->method;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function getStatusCode(): string
    {
        return $this->status_code;
    }

    public function getStatusDescription(): string
    {
        return $this->status_description;
    }

    public function getCreatedAt(): TranzzoDateTime
    {
        return $this->created_at;
    }

    public function getProcessingTime(): string
    {
        return $this->processing_time;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function isStatusSuccess(): bool
    {
        return $this->status->isSuccess();
    }

    public function isStatusFailure(): bool
    {
        return $this->status->isFailure();
    }

    public function isStatusPending(): bool
    {
        return $this->status->isPending();
    }

    public function isStatusInit(): bool
    {
        return $this->status->isInit();
    }
}

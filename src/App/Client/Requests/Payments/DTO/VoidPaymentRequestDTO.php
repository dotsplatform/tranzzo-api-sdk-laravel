<?php
/**
 * Description of RefundPaymentRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;

class VoidPaymentRequestDTO extends DTO
{
    protected string $pos_id;

    protected string $order_id;

    protected ?Currency $order_currency;

    protected ?string $comment;

    protected ?string $server_url;

    public function toRequestData(bool $stageEnv): array
    {
        $data = $this->toArray();
        if (! $stageEnv) {
            return $data;
        }

        $data['order_currency'] = Currency::XTS->value;

        return $data;
    }

    public function getPosId(): string
    {
        return $this->pos_id;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getOrderCurrency(): ?Currency
    {
        return $this->order_currency;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getServerUrl(): ?string
    {
        return $this->server_url;
    }
}

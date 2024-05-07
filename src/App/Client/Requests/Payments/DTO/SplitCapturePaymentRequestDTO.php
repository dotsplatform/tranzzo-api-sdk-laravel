<?php
/**
 * Description of ConfirmPaymentRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Split\SplitMerchants;

class SplitCapturePaymentRequestDTO extends DTO
{
    protected string $pos_id;

    protected string $order_id;

    protected ?float $charge_amount;

    protected ?Currency $currency;

    protected ?string $comment;

    protected ?string $server_url;

    protected SplitMerchants $split;

    public function toRequestData(bool $stageEnv): array
    {
        $data = $this->toArray();
        if (! $stageEnv) {
            return $data;
        }

        $data['currency'] = Currency::XTS->value;

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

    public function getChargeAmount(): ?float
    {
        return $this->charge_amount;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getServerUrl(): ?string
    {
        return $this->server_url;
    }

    public function getSplit(): SplitMerchants
    {
        return $this->split;
    }
}

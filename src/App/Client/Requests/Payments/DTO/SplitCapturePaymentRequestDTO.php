<?php
/**
 * Description of ConfirmPaymentRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Tranzzo\App\Client\Resources\Consts\CurrencyCode;
use Dots\Tranzzo\App\Client\Resources\Split\SplitMerchants;

class SplitCapturePaymentRequestDTO extends DTO
{
    protected string $pos_id;
    protected string $order_id;

    protected ?int $charge_amount;

    protected ?CurrencyCode $currency;

    protected ?string $comment;
    protected ?string $server_url;

    protected SplitMerchants $split;

    public function getPosId(): string
    {
        return $this->pos_id;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getChargeAmount(): ?int
    {
        return $this->charge_amount;
    }

    public function getCurrency(): ?CurrencyCode
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
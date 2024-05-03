<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\Tranzzo\App\Client\Resources\Consts\Currency;
use Dots\Tranzzo\App\Client\Resources\Consts\Order3DSBypass;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;

class CreateHostedPaymentRequestDTO extends DTO
{
    protected string $pos_id;

    protected PaymentMode $mode;

    protected PaymentMethod $method;

    protected int $amount;

    protected Currency $currency;

    protected ?string $description;

    protected string $order_id;

    protected ?string $server_url;

    protected ?string $result_url;

    protected Order3DSBypass $order_3ds_bypass;

    protected ?string $payload;

    protected ?string $customer_referrer;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function getServerUrl(): ?string
    {
        return $this->server_url;
    }

    public function getResultUrl(): ?string
    {
        return $this->result_url;
    }

    public function getOrder3dsBypass(): Order3DSBypass
    {
        return $this->order_3ds_bypass;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function getCustomerReferrer(): ?string
    {
        return $this->customer_referrer;
    }
}

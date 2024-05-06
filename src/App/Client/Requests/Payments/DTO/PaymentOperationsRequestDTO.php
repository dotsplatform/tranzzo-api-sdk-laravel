<?php
/**
 * Description of PaymentOperationsRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;

class PaymentOperationsRequestDTO extends DTO
{
    protected string $posId;

    protected string $orderId;

    public function getPosId(): string
    {
        return $this->posId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}

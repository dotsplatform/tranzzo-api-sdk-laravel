<?php
/**
 * Description of SplitMerchant.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Split;

use Dots\Data\DTO;

class SplitMerchant extends DTO
{
    protected string $sub_merchant_id;

    protected float $amount;

    public function getSubMerchantId(): string
    {
        return $this->sub_merchant_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}

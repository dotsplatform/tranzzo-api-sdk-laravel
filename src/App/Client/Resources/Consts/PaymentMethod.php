<?php
/**
 * Description of PaymentMethod.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum PaymentMethod: string
{
    case AUTH = 'auth';
    case PURCHASE = 'purchase';
    case CAPTURE = 'capture';
    case VOID = 'void';

    public function isAuth(): bool
    {
        return $this === self::AUTH;
    }

    public function isPurchase(): bool
    {
        return $this === self::PURCHASE;
    }

    public function isCapture(): bool
    {
        return $this === self::CAPTURE;
    }

    public function isVoid(): bool
    {
        return $this === self::VOID;
    }
}

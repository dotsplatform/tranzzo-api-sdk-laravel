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
}

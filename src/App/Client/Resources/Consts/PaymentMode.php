<?php
/**
 * Description of PaymentMode.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum PaymentMode: string
{
    case HOSTED = 'hosted';
    case DIRECT = 'direct';
}

<?php
/**
 * Description of CurrencyCode.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum CurrencyCode: int
{
    case USD = 840;
    case EUR = 978;
    case UAH = 980;
}

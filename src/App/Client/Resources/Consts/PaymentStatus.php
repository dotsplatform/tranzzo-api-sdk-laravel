<?php
/**
 * Description of PaymentStatus.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum PaymentStatus: string
{
    case INIT = 'init';
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILURE = 'failure';
}

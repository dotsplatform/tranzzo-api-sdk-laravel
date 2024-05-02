<?php
/**
 * Description of PaymentOperation.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum PaymentOperation: string
{
    case CREATE = 'create';
    case CONFIRM = 'confirm';
    case CANCEL = 'cancel';
    case REFUND = 'refund';
    case LOOKUP = 'lookup';
}

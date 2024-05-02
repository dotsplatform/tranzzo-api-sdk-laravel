<?php
/**
 * Description of CreatePaymentCustomerPaymentMethodType.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Consts;

enum PaymentMethodType: string
{
    case CC_TOKEN = 'cc_token';
    case WALLET = 'wallet';
    case GOOGLE_PAY = 'google_pay';
    case APPLE_PAY = 'apple_pay';
}

<?php
/**
 * Description of Transaction.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources;


use Dots\Data\Entity;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMethod;
use Dots\Tranzzo\App\Client\Resources\Consts\PaymentMode;

class Operation extends Entity
{
    protected string $operation_id;
    protected string $payment_id;
    protected string $order_id;
    protected string $transaction_id;
    protected string $pos_id;
    protected PaymentMode $mode;
    protected PaymentMethod $method;
    protected int $amount;
    protected string $currency;
    protected string $status;
    protected string $status_code;
    protected string $status_description;
    protected string $created_at;
    protected string $processing_time;
    protected ?int $fee;
    protected ?string $comment;

}
<?php
/**
 * Description of TestRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\Mock;

use Dots\Tranzzo\App\Client\Requests\BaseTranzzoRequest;

class TestRequest extends BaseTranzzoRequest
{
    public const ENDPOINT = 'blackhole';

    public function resolveEndpoint(): string
    {
        return self::ENDPOINT;
    }
}

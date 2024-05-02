<?php
/**
 * Description of CreateHostedPaymentResponse.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Responses;


use Dots\Data\DTO;
use RuntimeException;
use Saloon\Http\Response;

class CreateHostedPaymentResponseDTO extends DTO
{

    protected string $url;

    public static function fromResponse(Response $response): static
    {
        $url = $response->header('location');
        if ($url === null) {
            throw new RuntimeException('Location header is missing');
        }
        return static::fromArray([
            'url' => $url,
        ]);
    }

    public function getUrl(): string
    {
        return $this->url;
    }


}
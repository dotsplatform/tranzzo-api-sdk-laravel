<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Responses;

class ErrorResponseDTO extends TranzzoResponseDTO
{
    protected string $message;

    protected ?array $args;

    protected ?array $details;

    // usually code exists in args property
    protected ?string $code;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getArgs(): ?array
    {
        return $this->args;
    }

    public function getDetails(): ?array
    {
        return $this->details;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }
}

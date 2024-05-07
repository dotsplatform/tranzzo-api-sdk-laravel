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

    protected array $args;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getArgs(): array
    {
        return $this->args;
    }
}

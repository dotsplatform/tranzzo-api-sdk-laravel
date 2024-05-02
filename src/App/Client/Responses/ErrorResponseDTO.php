<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Responses;

class ErrorResponseDTO extends TranzzoResponseDTO
{
    protected string $errCode;

    protected string $errText;

    public function getErrCode(): string
    {
        return $this->errCode;
    }

    public function getErrText(): string
    {
        return $this->errText;
    }
}

<?php
/**
 * Description of TranzzoAuthDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Auth\DTO;

use Dots\Data\DTO;

class TranzzoAuthDTO extends DTO
{
    protected string $posId;
    protected string $endpointKey;
    protected string $apiKey;
    protected string $apiSecret;

    public function getPosId(): string
    {
        return $this->posId;
    }

    public function getEndpointKey(): string
    {
        return $this->endpointKey;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }


}

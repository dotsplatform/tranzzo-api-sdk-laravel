<?php
/**
 * Description of TranzzoWebhookDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources;

use Dots\Data\DTO;

class TranzzoWebhookDTO extends DTO
{
    protected string $signature;

    protected string $data;

    public function getDecodedData(): array
    {
        $data = base64_decode($this->getData());
        if (! $data) {
            return [];
        }

        $data = json_decode($data, true);
        if (! is_array($data)) {
            return [];
        }

        return $data;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function getData(): string
    {
        return $this->data;
    }
}

<?php
/**
 * Description of DateTime.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources;

use DateTime;
use Dots\Data\DTO;

class TranzzoDateTime extends DTO
{
    // Estimated time of arrival represented in a Coordinated Universal Time (UTC) string.
    // e.g. 2023-05-13T13:21:22Z
    protected DateTime $date;

    public static function fromString(string $date): static
    {
        return static::fromArray(['date' => $date]);
    }

    public function __toString(): string
    {
        return $this->date->format(DateTime::ATOM);
    }

    public static function fromTimestamp(int $timestamp): static
    {
        return static::fromArray(['date' => date(DateTime::ATOM, $timestamp)]);
    }

    public static function fromArray(array $data): static
    {
        // date is in ISO 8601 format
        // eg 2023-05-13T13:21:22Z
        $data['date'] = new DateTime($data['date']);

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date->format(DateTime::ATOM),
        ];
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getTimestamp(): int
    {
        return $this->date->getTimestamp();
    }
}

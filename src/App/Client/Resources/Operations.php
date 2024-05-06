<?php
/**
 * Description of Operations.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

/**
 * @extends Collection<int, Operation>
 */
class Operations extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $item) => Operation::fromArray($item),
            $data,
        ));
    }

    public function getLastOperation(): ?Operation
    {
        return $this->sortBy(
            fn (Operation $operation) => $operation->getCreatedAt(),
        )->last();
    }
}

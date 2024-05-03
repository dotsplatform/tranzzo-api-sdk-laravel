<?php
/**
 * Description of SplitMerchants.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Resources\Split;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

class SplitMerchants extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $item) => SplitMerchant::fromArray($item),
            $data
        ));
    }
}

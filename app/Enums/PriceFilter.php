<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class Prices
 *
 * @package App\Enums
 */
final class PriceFilter extends Enum
{
    const LESS_THAN_50     = 0;
    const FROM_50_TO_100   = 1;
    const FROM_100_TO_500  = 2;
    const FROM_500_TO_1000 = 3;
    const MORE_THAN_1000   = 4;
}

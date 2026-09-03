<?php

namespace App\Data;

use App\Utilities\Money;

final class Conversion extends Data
{
    public function __construct(
        public readonly Money $from,
        public readonly Money $to,
        public readonly float $rate,
    ) {}
}

<?php

namespace App\Data\Account;

use App\Data\Data;
use App\Enums\AccountCategory;
use App\Enums\AccountType;
use App\Enums\Currency;
use Spatie\LaravelData\Attributes\MapName;

class CreateAccountData extends Data
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly AccountType $type,
        public readonly AccountCategory $category,
        public readonly Currency|null $currency,
        #[MapName('is_postable')]
        public readonly bool $isPostable,
    ) {}
}

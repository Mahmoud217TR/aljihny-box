<?php

namespace App\Utilities;

use App\Enums\Currency;
use Cknow\Money\Money as CknowMoney;

final class Money extends CknowMoney
{
    public function getCurrencyCode(): string
    {
        return $this->getCurrency()->getCode();
    }

    public function getCurrencyEnum(): Currency
    {
        return Currency::from($this->getCurrencyCode());
    }
}

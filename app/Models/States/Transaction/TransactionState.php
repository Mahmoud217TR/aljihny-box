<?php

namespace App\Models\States\Transaction;

use App\Models\States\State;
use Spatie\ModelStates\StateConfig;

abstract class TransactionState extends State
{
    // abstract public function enum(): TransactionStatus;
    abstract public function label(): string;
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config();
    }
}

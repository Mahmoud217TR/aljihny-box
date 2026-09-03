<?php

namespace App\Models\States\Due;

use App\Enums\DueStatus;
use App\Models\States\State;
use Spatie\ModelStates\StateConfig;

abstract class DueState extends State
{

    abstract public function enum(): DueStatus;
    abstract public function label(): string;
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Unpaid::class)
            ->allowTransition(Unpaid::class, PartiallyPaid::class)
            ->allowTransition(PartiallyPaid::class, Paid::class);
    }
}

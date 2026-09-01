<?php

namespace App\Models\States\Admin;

use App\Enums\AdminStatus;
use App\Models\States\State;
use Spatie\ModelStates\StateConfig;

abstract class AdminState extends State
{
    abstract public function enum(): AdminStatus;
    abstract public function label(): string;
    abstract public function color(): string;
    abstract public function canLogin(): bool;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Active::class)
            ->allowTransition(Active::class, Suspended::class)
            ->allowTransition(Suspended::class, Active::class);
    }
}

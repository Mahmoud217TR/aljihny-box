<?php

namespace App\Models\States\Member;

use App\Enums\MemberStatus;
use App\Models\States\State;
use Spatie\ModelStates\StateConfig;

abstract class MemberState extends State
{
    abstract public function enum(): MemberStatus;
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

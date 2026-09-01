<?php

namespace App\Models\States\Due;

use App\Enums\DueStatus;
use Spatie\ModelStates\StateConfig;

class Unpaid extends DueState
{
    public function enum(): DueStatus
    {
        return DueStatus::Unpaid;
    }

    public function label(): string
    {
        return __('states.due.unpaid');
    }

    public function color(): string
    {
        return 'red';
    }

    public static function config(): StateConfig
    {
        return parent::config();
    }
}

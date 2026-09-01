<?php

namespace App\Models\States\Due;

use App\Enums\DueStatus;
use Spatie\ModelStates\StateConfig;

class PartiallyPaid extends DueState
{
    public function enum(): DueStatus
    {
        return DueStatus::PartiallyPaid;
    }

    public function label(): string
    {
        return __('states.due.partially_paid');
    }

    public function color(): string
    {
        return 'yellow';
    }

    public static function config(): StateConfig
    {
        return parent::config();
    }
}

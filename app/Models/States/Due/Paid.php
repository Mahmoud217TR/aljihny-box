<?php

namespace App\Models\States\Due;

use App\Enums\DueStatus;
use Spatie\ModelStates\StateConfig;

class Paid extends DueState
{
    public function enum(): DueStatus
    {
        return DueStatus::Paid;
    }

    public function label(): string
    {
        return __('states.due.paid');
    }

    public function color(): string
    {
        return 'green';
    }

    public static function config(): StateConfig
    {
        return parent::config();
    }
}

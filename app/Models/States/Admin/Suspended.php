<?php

namespace App\Models\States\Admin;

use App\Enums\AdminStatus;

class Suspended extends AdminState
{
    public function enum(): AdminStatus
    {
        return AdminStatus::Suspended;
    }

    public function label(): string
    {
        return __('states.admin.suspended');
    }

    public function color(): string
    {
        return 'yellow';
    }

    public function canLogin(): bool
    {
        return true;
    }
}

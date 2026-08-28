<?php

namespace App\Models\States\Admin;

use App\Enums\AdminStatus;

class Active extends AdminState
{
    public function enum(): AdminStatus
    {
        return AdminStatus::Active;
    }

    public function label(): string
    {
        return __('states.admin.active');
    }

    public function color(): string
    {
        return 'green';
    }

    public function canLogin(): bool
    {
        return true;
    }
}

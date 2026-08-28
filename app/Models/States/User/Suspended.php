<?php

namespace App\Models\States\User;

use App\Enums\UserStatus;

class Suspended extends UserState
{
    public function enum(): UserStatus
    {
        return UserStatus::Suspended;
    }

    public function label(): string
    {
        return __('states.user.suspended');
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

<?php

namespace App\Models\States\User;

use App\Enums\UserStatus;

class Active extends UserState
{
    public function enum(): UserStatus
    {
        return UserStatus::Active;
    }

    public function label(): string
    {
        return __('states.user.active');
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

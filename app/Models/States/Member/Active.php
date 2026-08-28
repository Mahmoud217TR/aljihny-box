<?php

namespace App\Models\States\Member;

use App\Enums\MemberStatus;

class Active extends MemberState
{
    public function enum(): MemberStatus
    {
        return MemberStatus::Active;
    }

    public function label(): string
    {
        return __('states.member.active');
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

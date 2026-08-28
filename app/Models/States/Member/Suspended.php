<?php

namespace App\Models\States\Member;

use App\Enums\MemberStatus;

class Suspended extends MemberState
{
    public function enum(): MemberStatus
    {
        return MemberStatus::Suspended;
    }

    public function label(): string
    {
        return __('states.member.suspended');
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

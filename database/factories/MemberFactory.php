<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Member;
use App\Models\States\Member\Active;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
final class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => User::factory(),
            'state' => Active::class,
        ];
    }
}

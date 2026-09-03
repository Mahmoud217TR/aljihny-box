<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\DuePeriod;
use App\Enums\DueStatus;
use App\Models\Due;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Due>
 */
final class DueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => DueStatus::Unpaid->value,
            'period' => fake()->randomElement(DuePeriod::cases()),
            'member_id' => Member::factory(),
            'currency' => Currency::SYP->value,
            'amount' => fake()->randomFloat(2, 1, 100_000),
            'due_date' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\AccountCategory;
use App\Enums\AccountType;
use App\Enums\Currency;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Account>
 */
final class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'account_id' => null,
            'type' => fake()->randomElement(AccountType::cases()),
            'category' => fake()->randomElement(AccountCategory::cases()),
            'currency' => Currency::SYP->value,
            'balance' => fake()->randomFloat(2, 0, 1_000_000),
            'is_postable' => true,
        ];
    }
}

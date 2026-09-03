<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Currency;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
final class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'transaction_id' => Transaction::factory(),
            'receiver_id' => Admin::factory(),
            'currency' => Currency::SYP->value,
            'amount' => fake()->randomFloat(2, 1, 100_000),
            'payed_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

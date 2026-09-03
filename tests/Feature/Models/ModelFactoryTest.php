<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Due;
use App\Models\Entry;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ModelFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_each_model_factory_creates_a_persisted_model(): void
    {
        $models = [
            User::factory()->create(),
            Admin::factory()->create(),
            Member::factory()->create(),
            Account::factory()->create(),
            Transaction::factory()->create(),
            Entry::factory()->create(),
            Payment::factory()->create(),
            Due::factory()->create(),
        ];

        foreach ($models as $model) {
            $this->assertModelExists($model);
        }
    }
}

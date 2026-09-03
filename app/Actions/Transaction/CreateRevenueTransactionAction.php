<?php

namespace App\Actions\Transaction;

use App\Actions\Entry\CreateEntryAction;
use App\Enums\EntryType;
use App\Models\Account;
use App\Models\Transaction;
use App\Utilities\Money;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class CreateRevenueTransactionAction
{
    public function __construct(
        private readonly CreateEntryAction $createEntryAction
    ) {}

    /**
     * Create a revenue transaction.
     *
     * @param string $description The description of the revenue.
     * @param Account $cashbox The cashbox account.
     * @param Money $amount The amount of the revenue.
     * @param Carbon|null $at The date and time at which the transaction occurred.
     *
     * @return Transaction The newly created transaction.
     */
    public function execute(
        string $description,
        Account $cashbox,
        Money $amount,
        Carbon|null $at = null
    ): Transaction {
        return DB::transaction(function () use ($description, $cashbox, $amount, $at) {
            $transaction = Transaction::create([
                'description' => __("Revenue :description, to :cashbox", [
                    'description' => $description,
                    'cashbox' => $cashbox->name
                ]),
                'at' => $at ?? now(),
            ]);

            $this->createEntryAction->execute($transaction, $cashbox, EntryType::Debit, $amount);

            $this->createEntryAction->execute($transaction, Account::findByCode(4300), EntryType::Credit, $amount);

            return $transaction;
        });
    }
}

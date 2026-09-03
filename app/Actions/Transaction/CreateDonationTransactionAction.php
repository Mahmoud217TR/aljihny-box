<?php

namespace App\Actions\Transaction;

use App\Actions\Entry\CreateEntryAction;
use App\Enums\EntryType;
use App\Models\Account;
use App\Models\Transaction;
use App\Utilities\Money;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class CreateDonationTransactionAction
{
    public function __construct(
        private readonly CreateEntryAction $createEntryAction
    ) {}

    /**
     * Create a transaction for the donatio
     *
     * @param string $donatorName
     * @param Account $collector
     * @param Money $amount
     * @param Carbon|null|null $at
     *
     * @return Transaction
     */
    public function execute(
        string $donatorName,
        Account $collector,
        Money $amount,
        Carbon|null $at = null
    ): Transaction {
        return DB::transaction(function () use ($donatorName, $collector, $amount, $at) {
            $transaction = Transaction::create([
                'description' => __("Donation received from :name", ['name' => $donatorName]),
                'at' => $at ?? now(),
            ]);

            $this->createEntryAction->execute($transaction, $collector, EntryType::Debit, $amount);

            $this->createEntryAction->execute($transaction, Account::findByCode(4200), EntryType::Credit, $amount);

            return $transaction;
        });
    }
}

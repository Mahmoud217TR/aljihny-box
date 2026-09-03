<?php

namespace App\Actions\Transaction;

use App\Actions\Entry\CreateEntryAction;
use App\Enums\EntryType;
use App\Models\Account;
use App\Models\Due;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class CreateDuePaymentTransactionAction
{
    public function __construct(
        private readonly CreateEntryAction $createEntryAction
    ) {}

    /**
     * Create a payment transaction for the given due.
     *
     * @param Account $collector The account that collects the payment.
     * @param Due $due The due for which the transaction is being created.
     * @param Carbon|null $at The date and time at which the transaction occurred.
     *
     * @return Transaction The newly created transaction.
     */
    public function execute(Account $collector, Due $due, Carbon|null $at = null): Transaction
    {
        return DB::transaction(function () use ($collector, $due, $at) {
            $transaction = Transaction::create([
                'description' => __("Due payment for :period", ['period' => __("period." . $due->period->value)]),
                'at' => $at ?? now(),
            ]);

            $this->createEntryAction->execute($transaction, $collector, EntryType::Debit, $due->amount);

            $this->createEntryAction->execute($transaction, Account::findByCode(1300), EntryType::Credit, $due->amount);

            return $transaction;
        });
    }
}

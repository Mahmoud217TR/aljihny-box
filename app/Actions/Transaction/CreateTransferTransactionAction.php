<?php

namespace App\Actions\Transaction;

use App\Actions\Entry\CreateEntryAction;
use App\Enums\EntryType;
use App\Models\Account;
use App\Models\Transaction;
use App\Utilities\Money;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class CreateTransferTransactionAction
{
    public function __construct(
        private readonly CreateEntryAction $createEntryAction
    ) {}

    /**
     * Create a transfer transaction between two accounts.
     *
     * @param Account $source The account from which the transfer is initiated.
     * @param Account $destination The account to which the transfer is made.
     * @param Money $amount The amount to be transferred.
     * @param Carbon|null $at The date and time at which the transaction occurred.
     *
     * @return Transaction The newly created transaction.
     */
    public function execute(Account $source, Account $destination, Money $amount, Carbon|null $at = null): Transaction
    {
        return DB::transaction(function () use ($source, $destination, $amount, $at) {
            $transaction = Transaction::create([
                'description' => __("Transfer from :source to :destination", [
                    'source' => $source->name,
                    'destination' => $destination->name
                ]),
                'at' => $at ?? now(),
            ]);

            $this->createEntryAction->execute($transaction, $source, EntryType::Debit, $amount);

            $this->createEntryAction->execute($transaction, $destination, EntryType::Credit, $amount);

            return $transaction;
        });
    }
}

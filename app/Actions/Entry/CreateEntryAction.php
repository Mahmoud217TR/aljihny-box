<?php

namespace App\Actions\Entry;

use App\Actions\Account\UpdateBalanceAction;
use App\Enums\EntryType;
use App\Exceptions\AccountNotPostableException;
use App\Models\Account;
use App\Models\Entry;
use App\Models\Transaction;
use App\Utilities\Money;
use Illuminate\Support\Facades\DB;
use Money\Exception\CurrencyMismatchException;

final class CreateEntryAction
{
    public function __construct(
        private readonly UpdateBalanceAction $updateBalanceAction
    ) {}
    /**
     * Create a new entry for the given account with the specified type and amount.
     *
     * @param Account $account The account for which the entry is being created.
     * @param EntryType $type The type of the entry (Debit or Credit).
     * @param Money $amount The amount for the entry, represented as a Money object.
     *
     * @return Entry The newly created entry.
     */
    public function execute(
        Transaction $transaction,
        Account $account,
        EntryType $type,
        Money $amount
    ): Entry {
        return DB::transaction(function () use ($transaction, $account, $type, $amount) {
            throw_unless(
                $account->isPostable,
                new AccountNotPostableException(),
            );

            throw_unless(
                $account->currency === null || $account->currency === $amount->getCurrencyCode(),
                new CurrencyMismatchException($account->currency, $amount->getCurrencyCode())
            );

            $entry = $transaction->entries()->create([
                'account_id' => $account->id,
                'type' => $type,
                'amount' => $amount,
                'currency' => $amount->getCurrencyCode(),
            ]);

            $this->updateBalanceAction->execute($account, $entry);

            return $entry;
        });
    }
}

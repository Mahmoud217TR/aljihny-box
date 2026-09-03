<?php

namespace App\Actions\Account;

use App\Models\Account;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;

final class UpdateBalanceAction
{
    /**
     * Update the balance of the given account based on the provided entry.
     *
     * @param Account $account The account whose balance is to be updated.
     * @param Entry $entry The entry that affects the account's balance.
     *
     * @return Account The updated account with the new balance.
     */
    public function execute(Account $account, Entry $entry): Account
    {
        return DB::transaction(function () use ($account, $entry) {
            if ($account->haveToIncreaseFor($entry->type)) {
                $account->balance = $account->balance->add($entry->amount);
            } else {
                $account->balance = $account->balance->subtract($entry->amount);
            }
            $account->save();
            return $account;
        });
    }
}

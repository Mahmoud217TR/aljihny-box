<?php

namespace App\Actions\Account;

use App\Data\Account\CreateAccountData;
use App\Exceptions\AccountAttributesMismatchException;
use App\Models\Account;
use App\Utilities\Money;
use Illuminate\Support\Facades\DB;

class CreateAccountAction
{
    /**
     * Create a new account.
     *
     * @param CreateAccountData $data The data for creating the account.
     * @param Account|null $parent The parent account, if any.
     *
     * @return Account The created account.
     *
     * @throws AccountAttributesMismatchException If the parent account's attributes do not match the new
     */
    public function execute(CreateAccountData $data, Account|null $parent = null): Account
    {
        return DB::transaction(function () use ($data, $parent) {

            if (filled($parent)) {
                throw_if(
                    $parent->category !== $data->category || $parent->type !== $data->type,
                    new AccountAttributesMismatchException()
                );
            }

            return Account::create([
                'name' => $data->name,
                'type' => $data->type,
                'category' => $data->category,
                'balance' => $data->currency ? new Money(0, $data->currency->value) : null,
                'currency' => $data->currency?->value,
                'is_postable' => $data->isPostable,
                'account_id' => $parent?->id,
            ]);
        });
    }
}

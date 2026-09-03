<?php

namespace App\Actions\Transaction;

use App\Actions\Entry\CreateEntryAction;
use App\Data\Conversion;
use App\Enums\EntryType;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class CreateUSDPurchaseTransactionAction
{
    public function __construct(
        private readonly CreateEntryAction $createEntryAction
    ) {}

    /**
     * Create a USD purchase transaction.
     *
     * @param Account $cashbox The cashbox account.
     * @param Conversion $conversion The conversion details.
     * @param Carbon|null $at The date and time at which the transaction occurred.
     *
     * @return Transaction The newly created transaction.
     */
    public function execute(
        Account $cashbox,
        Conversion $conversion,
        Carbon|null $at = null
    ): Transaction {
        return DB::transaction(function () use ($cashbox, $conversion, $at) {
            $transaction = Transaction::create([
                'description' => __("Purchased USD from :cashbox", [
                    'cashbox' => $cashbox->name
                ]),
                'at' => $at ?? now(),
                'metadata' => $conversion->toArray(),
            ]);

            $this->createEntryAction->execute($transaction, Account::findByCode(1200), EntryType::Debit, $conversion->to);

            $this->createEntryAction->execute($transaction, $cashbox, EntryType::Credit, $conversion->from);

            return $transaction;
        });
    }
}

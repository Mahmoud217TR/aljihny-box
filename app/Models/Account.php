<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\AccountCategory;
use App\Enums\Currency;
use App\Enums\EntryType;
use App\Utilities\Money;
use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $code
 * @property string $name
 * @property int|null $account_id
 * @property AccountType $type
 * @property AccountCategory $category
 * @property Money|null $balance
 * @property string|null $currency
 * @property boolean $is_postable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['code', 'name', 'type', 'category', 'balance', 'currency', 'is_postable'])]
class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => AccountType::class,
            'category' => AccountCategory::class,
            'balance' => MoneyDecimalCast::class.':currency',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Account::class, 'account_id', 'id');
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public static function findByCode(int $code): ?Account
    {
        return self::where('code', $code)->first();
    }

    public function haveToIncreaseFor(EntryType $type): bool
    {
        return $this->type == AccountType::CreditNormal && $type == EntryType::Credit
            || $this->type == AccountType::DebitNormal && $type == EntryType::Debit;
    }
}

<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\AccountCategory;
use App\Enums\Currency;
use App\Utilities\Money;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int|null $account_id
 * @property AccountType $type
 * @property AccountCategory $category
 * @property Money|null $balance
 * @property Currency|null $currency
 * @property boolean $is_postable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['name', 'type', 'category', 'balance', 'currency', 'is_postable'])]
class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

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
}

<?php

namespace App\Models;

use App\Enums\DuePeriod;
use App\Utilities\Money;
use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $state
 * @property int|null $member_id
 * @property DuePeriod $period
 * @property Money $amount
 * @property string $currency
 * @property Carbon $due_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['state', 'period', 'amount', 'currency', 'due_date'])]
class Due extends Model
{
    /** @use HasFactory<\Database\Factories\DueFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'period' => DuePeriod::class,
            'amount' => MoneyDecimalCast::class.':currency',
            'due_date' => 'datetime',
        ];
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}

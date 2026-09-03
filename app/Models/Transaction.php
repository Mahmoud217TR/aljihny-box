<?php

namespace App\Models;

use App\Models\States\Transaction\TransactionState;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\ModelStates\HasStates;

/**
 * @property int $id
 * @property TransactionState $state
 * @property string|null $description
 * @property Carbon $at
 * @property object|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['state', 'description', 'at', 'metadata'])]
class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    use HasStates;

    protected function casts(): array
    {
        return [
            'state' => TransactionState::class,
            'at' => 'datetime',
            'metadata' => 'object',
        ];
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }
}

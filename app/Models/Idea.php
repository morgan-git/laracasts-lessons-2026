<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\IdeaState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use App\Models\Step;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @property int $id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $state
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Idea whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Idea extends Model
{
    protected $guarded = [];

    protected $casts = [
        'state' => IdeaState::class,
        'links' => AsArrayObject::class,
    ];

    //initial attributes set for the model
    protected $attributes = [
        'state' => IdeaState::PENDING,
        'links' => '[]',
    ];

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    // Generates the ->pending() method
    public function scopePending(Builder $query): void
    {
        $query->where('state', IdeaState::PENDING);
    }

    // Generates a dynamic ->ofState($state) method
    public function scopeOfState(Builder $query, IdeaState $state): void
    {
        $query->where('state', $state);
    }
}

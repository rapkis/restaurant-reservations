<?php declare(strict_types = 1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Table extends Model
{
    protected $fillable = [
        'capacity',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function scopeAvailableBetween($query, Carbon $start, Carbon $end)
    {
        return $query->whereDoesntHave('reservations', function (Builder $builder) use ($start, $end) {
            $builder
                ->where('reservation_start', '<=', $end)
                ->where('reservation_end', '>=', $start);
        });
    }
}

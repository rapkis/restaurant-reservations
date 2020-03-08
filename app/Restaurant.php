<?php declare(strict_types = 1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'open_time',
        'close_time',
    ];

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function setOpenTimeAttribute($value)
    {
        $this->attributes['open_time'] = Carbon::parse($value)->toTimeString();
    }

    public function setCloseTimeAttribute($value)
    {
        $this->attributes['close_time'] = Carbon::parse($value)->toTimeString();
    }

    public function getOpenTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function getCloseTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

}

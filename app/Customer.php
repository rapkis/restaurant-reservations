<?php declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Helper\Contract;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'standard_rack_rate'
    ];

    protected $casts = [
        'description' => 'array'
    ];

    public function contracts()
    {
        Helper\Contract::contracts('accommodation_id');
   }
    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

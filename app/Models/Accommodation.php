<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\traits\Contract;

class Accommodation extends Model
{
    use HasFactory, Contract;

    protected $casts = [
        'description' => 'array'
    ];

}

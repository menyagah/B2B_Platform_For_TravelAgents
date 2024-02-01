<?php

namespace App\Models\traits;

trait Contract
{
    public function contracts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Contract::class, 'accommodation_id');
    }
}

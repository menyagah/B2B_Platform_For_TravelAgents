<?php

namespace App\Models\Helper;

use PhpParser\Builder\Class_;

Class Contract
{
    public static function contracts(string $attr_id): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return \App\Models\Contract::class->hasMany(\App\Models\Contract::class, $attr_id);
    }

    public function getTitleUpperCaseAttribute(): string
    {
        return strtoupper($this->title);
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = strtolower($value);
    }
}

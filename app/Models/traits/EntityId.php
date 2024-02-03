<?php

namespace App\Models\traits;

trait EntityId
{
    public function foreignKeyId($attr): int
    {
        $count = $attr::query()->count();
        if($count === 0){
            return $attrId = $attr::factory()->create()->id;
        }else{
            return $attrId = rand(1, $count);
        }
    }
}

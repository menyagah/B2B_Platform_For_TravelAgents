<?php

namespace Database\Factories\Helpers;

class FactoryHelper
{
    /*
     *This function will get a random model id
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model): int
    {
        $count = $model::query()->count();
        if($count === 0){
            return $attrId = $model::factory()->create()->id;
        }else{
            return $attrId = rand(1, $count);
        }
    }
    public static function getContractOrStandardRate()
    {

    }
}

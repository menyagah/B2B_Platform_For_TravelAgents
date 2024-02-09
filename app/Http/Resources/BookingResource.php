<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'accommodation_id'=> $this->accommodation_id,
            'user_id'=> $this->user_id,
            'contract_id'=>$this->contract_id,
            'contract_rate' => $this->contract_rate,
            'standard_rack_rate'=> $this->standard_rack_rate,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}

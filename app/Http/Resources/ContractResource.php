<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'contract_rate'=> $this->contract_rate,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'accommodation_id'=> $this->accommodation_id,
            'user_id'=> $this->user_id,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at
        ];
    }
}

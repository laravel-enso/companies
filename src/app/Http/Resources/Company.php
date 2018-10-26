<?php

namespace LaravelEnso\Companies\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'position' => $this->position,
            'name' => $this->person->name,
            'phone' => $this->person->phone,
            'email' => $this->person->email,
            'createdAt' => $this->created_at->toDatetimeString(),
        ];
    }
}

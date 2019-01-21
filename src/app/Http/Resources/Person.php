<?php

namespace LaravelEnso\Companies\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Person extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'createdAt' => $this->created_at->toDatetimeString(),
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    public $collects = Subscriber::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'state' => $this->state,
            'fields' => FieldResource::collection($this->whenLoaded('fields')),
        ];
    }
}

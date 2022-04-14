<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subscriber extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=> [
                'type'=> 'subscribers',
                'subscriber_id'=> $this->id,
                'attributes'=> [
                    'name'=>$this->name,
                    'email'=>$this->email,
                    'address'=>$this->address,
                    'state'=>$this->state
                    ]
                ]
            ];
    }
}

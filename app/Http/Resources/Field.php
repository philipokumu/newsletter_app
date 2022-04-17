<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Field extends JsonResource
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
                'type'=> 'fields',
                'field_id'=> $this->id,
                'attributes'=> [
                    'value'=>$this->value,
                    'type'=>$this->type,
                    'slug'=>$this->slug,
                    ]
                ]
            ];
    }
}

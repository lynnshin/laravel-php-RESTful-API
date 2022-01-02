<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CatagoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*  也可以這樣寫
            return [
                'id'=>$this->id,
                'name'=>$this->name
            ];
        */
        
        $catagoryArray = parent::toArray($request);
        unset($catagoryArray['catagory_id']);
        unset($catagoryArray['user_id']);
        unset($catagoryArray['created_at']);
        unset($catagoryArray['updated_at']);

        return $catagoryArray;
        
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name_uz'=>$this->name_uz,
            'name_ru'=>$this->name_ru,
            'name_kr'=>$this->name_kr,
            'price'=>$this->price,
            'unit_name'=>Unit::where('id',$this->unit_id)->first()->name,
            'photo'=>$this->photo,
        ];
    }
}

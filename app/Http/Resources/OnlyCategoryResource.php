<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlyCategoryResource extends JsonResource
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
            'company_id'=>$this->company_id,
            'slug'=>$this->slug,
            'name_uz'=>$this->name_uz,
            'name_ru'=>$this->name_ru,
            'name_kr'=>$this->name_kr,
            'photo'=>$this->photo,
        ];
    }
}

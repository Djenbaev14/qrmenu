<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlyProCatResource extends JsonResource
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
            'products'=>new OnlyProductResource(Product::where('id',$this->id)->where('is_active',1)->where('deleted_at',null)->orderBy('id','desc')->get())
        ];
    }
}

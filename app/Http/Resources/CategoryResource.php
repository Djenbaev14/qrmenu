<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this[0]->id,
            'company_id'=>$this[0]->company_id,
            'slug'=>$this[0]->slug,
            'name_uz'=>$this[0]->name_uz,
            'name_ru'=>$this[0]->name_ru,
            'name_kr'=>$this[0]->name_kr,
            'photo'=>$this[0]->photo,
            'products'=>ProductResource::collection(Product::where('category_id',$this[0]->id)->where('is_active',1)->where('deleted_at',null)->orderBy('id','desc')->get())
        ];
    }
}

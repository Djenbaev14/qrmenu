<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompCamProductsResource extends JsonResource
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
            'name'=>$this[0]->name,
            'logo'=>$this[0]->logo,
            'slug'=>$this[0]->slug,
            'description_uz'=>$this[0]->description_uz,
            'description_ru'=>$this[0]->description_ru,
            'description_kr'=>$this[0]->description_kr,
            'telephones'=>$this[0]->telephones,
            'telegram'=>$this[0]->telegram,
            'instagram'=>$this[0]->instagram,
            'address'=>$this[0]->address,
            // 'category_id'=>$this[0]->category[0]->id,
            'categories'=>new CategoryResource(Category::where('id',$this[0]->category[0]->id)->where('main_category_id',null)->where('deleted_at',null)->orderBy('id','desc')->get())
        ];
    }
}

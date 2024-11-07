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
            'id'=>$this->id,
            'name'=>$this->name,
            'logo'=>$this->logo,
            'slug'=>$this->slug,
            'description_uz'=>$this->description_uz,
            'description_ru'=>$this->description_ru,
            'description_kr'=>$this->description_kr,
            'telephones'=>$this->telephones,
            'telegram'=>$this->telegram,
            'instagram'=>$this->instagram,
            'address'=>$this->address,
            'categories'=>new CategoryResource(Category::where('id',$this->category[0]->id)->where('main_category_id',null)->where('deleted_at',null)->orderBy('id','desc')->first())
        ];
    }
}

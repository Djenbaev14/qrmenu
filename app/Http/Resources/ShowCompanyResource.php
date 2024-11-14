<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'logo'=>$this->logo,
            'slug'=>$this->slug,
            'banner_image'=>$this->banner_image,
            'banner_text_uz'=>$this->banner_text_uz,
            'banner_text_ru'=>$this->banner_text_ru,
            'banner_text_kr'=>$this->banner_text_kr,
            'description_uz'=>$this->description_uz,
            'description_ru'=>$this->description_ru,
            'description_kr'=>$this->description_kr,
            'telephones'=>$this->telephones,
            'telegram'=>$this->telegram,
            'instagram'=>$this->instagram,
            'youtube'=>$this->youtube,
            'facebook'=>$this->facebook,
            'address'=>$this->address,
        ];
    }
}

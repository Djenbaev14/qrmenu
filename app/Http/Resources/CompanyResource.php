<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            'name'=>$this->name,
            'logo'=>$this->logo,
            'slug'=>$this->slug,
            'banner_image'=>$this->banner_image,
            'telephone'=>$this->telephone,
            'telegram'=>$this->telegram,
            'instagram'=>$this->instagram,
            'address'=>$this->address,
        ];
    }
}

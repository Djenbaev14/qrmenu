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
            'id'=>$this->id,
            'name'=>$this->name,
            'logo'=>$this->logo,
            'slug'=>$this->slug,
            'telephones'=>$this->telephones,
            'telegram'=>$this->telegram,
            'instagram'=>$this->instagram,
            'youtube'=>$this->youtube,
            'facebook'=>$this->facebook,
            'address'=>$this->address,
        ];
    }
}

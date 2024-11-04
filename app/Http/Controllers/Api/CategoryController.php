<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompCamProductsResource;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($company_slug,$category_slug)
    {
        return CompCamProductsResource::collection(Company::where('slug',$company_slug)->where('deleted_at',null)->whereHas('category', function (Builder $query) use($category_slug){
            $query->where('slug', $category_slug);
        })->orderBy('id','desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($company_name,$id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProComCamResource;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($company_slug,$category_slug,$product_slug)
    {
        
        return new ProComCamResource(Company::where('slug',$company_slug)->where('deleted_at',null)
        ->with(['category' => function ($query) use($category_slug,$product_slug) {
            $query->where('slug', $category_slug)->with(['product' => function ($query) use($product_slug) {
                $query->where('slug',$product_slug)->orderBy('id','desc');
            }]);
        }])
        ->orderBy('id','desc')->first());
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
    public function show(string $id)
    {
        //
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

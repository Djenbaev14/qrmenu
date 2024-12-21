<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ShowProductResource;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function index($restaurant_slug,$category_id,$product_id)
    {
        
        try {
            $restaurant = new CompanyResource(Company::where('slug',$restaurant_slug)->where('deleted_at',null)->firstOrFail());
    
            $category = new CategoryResource($restaurant->category()->where('id',$category_id)->where('deleted_at',null)->firstOrFail());
    
            $product = new ShowProductResource($category->product()->where('id',$product_id)->where('is_active',1)->where('deleted_at',null)->firstOrFail()); // Sahifada 10 ta mahsulot
            
            return response()->json([
                'restaurant' => $restaurant,
                'category' => $category,
                'products' => $product
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found',
                'message' => 'The specified company or category does not exist'
            ], 404);
        }
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

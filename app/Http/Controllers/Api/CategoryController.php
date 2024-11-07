<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompCamProductsResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($company_slug,$category_slug)
    {
        try {
            $company = new CompanyResource(Company::where('slug',$company_slug)->where('deleted_at',null)->firstOrFail());
    
            $category = new CategoryResource($company->category()->where('slug',$category_slug)->where('deleted_at',null)->firstOrFail());
    
            $products = $category->product()->where('is_active',1)->where('deleted_at',null)->orderBy('id','desc')->paginate(10); // Sahifada 10 ta mahsulot
            ProductResource::collection(($products));
            
            return response()->json([
                'company' => $company,
                'category' => $category,
                'products' => $products
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found',
                'message' => 'The specified company or category does not exist'
            ], 404);
        }
    }

    public function store(Request $request)
    {
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

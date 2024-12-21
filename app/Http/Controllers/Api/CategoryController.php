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
    public function index($restaurant_slug,$category_id,Request $request)
    {
            $restaurant = Company::where('slug',$restaurant_slug)->where('deleted_at',null)->firstOrFail();
            if (!$restaurant) {
                return response()->json([
                    'error' => 'Restoran topilmadi',
                    'message' => 'mavjud emas'
                ], 404);
            }
            
            $category = $restaurant->category()->where('id',$category_id)->where('is_active',1)->where('deleted_at',null)->firstOrFail();
            if (!$category) {
                return response()->json([
                    'error' => 'Restoran topilmadi',
                    'message' => 'mavjud emas'
                ], 404);
            }

            if($request->has('lang')){
                $products = $category->product()->where('name_'.$request->lang,'LIKE','%'.$request->search.'%')->where('is_active',1)->where('deleted_at',null)->orderBy('sequence_number','asc')->paginate(50);
            }else{
                $products = $category->product()->where('is_active',1)->where('deleted_at',null)->orderBy('sequence_number','asc')->paginate(50);
            }
            if ($products->isEmpty()) {
                $products = ['message' => 'Mavjud emas'];
            } else {
                $products = ProductResource::collection(($products));
            }
            
            
            return response()->json([
                'restaurant' => new CompanyResource($restaurant),
                'category' => new CategoryResource($category),
                'products' => $products
            ]);
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

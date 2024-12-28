<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\ShowCompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = CompanyResource::collection(Company::where('deleted_at',null)->orderBy('id','desc')->get());
        return response()->json([
            'restaurants' => $restaurants,
        ]); 
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
    public function show($restaurant_slug,Request $request)
    {
        $restaurant = Company::where('slug',$restaurant_slug)->where('deleted_at',null)->first();
        if (!$restaurant) {
            return response()->json([
                'error' => 'Restoran topilmadi',
                'message' => 'mavjud emas'
            ], 404);
        }
        if($request->has('lang')){
            $category =$restaurant->category()
            ->where('name_'.$request->lang,'LIKE','%'.$request->search.'%')->where('is_active',1)->where('deleted_at',null)->orderBy('sequence_number','asc')->get();
        }else{
            $category =$restaurant->category()
            ->where('deleted_at',null)->orderBy('sequence_number','asc')->get();
        }
        if ($category->isEmpty()) {
            $category = ['message' => 'Mavjud emas'];
        } else {
            $category = CategoryResource::collection($category);
        }

        
        return response()->json([
            'restaurant' => new CompanyResource($restaurant),
            'request'=>$request->all,
            'category' => $category,
        ]);
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

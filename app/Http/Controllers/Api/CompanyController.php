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
    public function show($restaurant_slug)
    {
        $restaurant = new ShowCompanyResource(Company::where('slug',$restaurant_slug)->where('deleted_at',null)->first());
        
        $category = CategoryResource::collection($restaurant->category()->where('deleted_at',null)->orderBy('sequence_number','asc')->get());
        // $feedback = FeedbackResource::collection($company->feedback()->orderBy('id','desc')->get());
        return response()->json([
            'restaurant' => $restaurant,
            'category' => $category,
            // 'feedback' => $feedback,
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

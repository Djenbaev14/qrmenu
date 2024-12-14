<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AllCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $categories = Category::where('name_uz', 'like', '%' . $search . '%')->where('deleted_at',null)->orderBy('id','desc')->paginate(1);
        $categories->appends(request()->query());
        $companies=Company::where('deleted_at',null)->orderBy('id','desc')->get();
        $select_categories=Category::where('deleted_at',null)->orderBy('id','desc')->get();
        return view('pages.all-categories.index', compact('categories','select_categories','companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_kr' => 'required',
            'company_id' => 'required',
            'photo'=>'required'
        ]);
        
        $file = $request->file('photo');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/categories'), $fileName);

        // slug
        $slug = Str::slug($request->name_uz);
        $count = Category::where('company_id',$request->company_id)->where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;

            $category=new Category;
            $category->user_id =  auth()->user()->id;
            $category->company_id =  $request->company_id;
            $category->name_uz =  $request->name_uz;
            $category->name_ru =  $request->name_ru;
            $category->name_kr =  $request->name_kr;
            $category->photo =  $fileName;
            $category->main_category_id =  ($request->main_category_id=="none") ? null : $request->main_category_id;
            $category->slug= $slug;
            $category->save();
            

        return redirect()->route('all-categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function getCategories(Request $request)
    {
        $categories = Category::where('company_id', $request->company_id)->get();
        return response()->json($categories);
    }
}

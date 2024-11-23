<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company_id=auth()->user()->company->id;
        $search = $request->input('search', '');
        $select_categories=Category::where('company_id',$company_id)->where('deleted_at',null)->orderBy('id','desc')->get();
        $categories = Category::where('company_id',$company_id)->where('name_uz','LIKE','%'.$search.'%')->where('deleted_at',null)->orderBy('id', 'DESC')->paginate(10);
        $categories->appends(request()->query());
        return view('pages.categories.index',compact('categories','search','select_categories'));
    }
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
            'photo'=>'required'
        ]);
        
        $file = $request->file('photo');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/categories'), $fileName);

        // slug
        $slug = Str::slug($request->name_uz);
        $count = Category::where('company_id',auth()->user()->company->first()->id)->where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;

            $category=new Category;
            $category->user_id =  auth()->user()->id;
            $category->company_id =  auth()->user()->company->id;
            $category->name_uz =  $request->name_uz;
            $category->name_ru =  $request->name_ru;
            $category->name_kr =  $request->name_kr;
            $category->photo =  $fileName;
            $category->main_category_id =  ($request->main_category_id=="none") ? null : $request->main_category_id;
            $category->slug= $slug;
            $category->save();
            
            event(new AttachmentEvent($request->photo, $category->icon(), 'categories'));

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $company_id=auth()->user()->company->id;
        if(Category::where('id',$id)->where('company_id',$company_id)->exists()){
            $search = $request->input('search', '');
            
            $products = Product::where('name_uz','LIKE','%'.$search.'%')->where('category_id',$id)->where('deleted_at',null)->orderBy('id', 'DESC')->paginate(10);
            $products->appends(request()->query());
            $category = Category::where('id',$id)->where('deleted_at',null)->orderBy('id', 'DESC')->first();
            $categories = Category::where('deleted_at',null)->orderBy('id', 'DESC')->get();
            $units=Unit::all();
            return view('pages.categories.show',compact('products','categories','category','units','search'));
        }else{
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_kr' => 'required',
            'photo'=>'required'
        ]);
        $category=Category::find($id);
        if($request->hasFile('photo') && file_exists(public_path('images/categories/' . $category->photo))){
            unlink(public_path('images/categories/' . $category->photo));
        }
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $fileName);
        }else{
            $fileName=$category->photo;
        }
        // slug
        $slug = Str::slug($request->name_kr);
        if($slug==Category::find($id)->slug){
            $slug=Category::find($id)->slug;
        }else{
            $count = Category::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
            $slug = $count ? "{$slug}-{$count}" : $slug;
        }

        if($request->main_category_id=="none"){
            $category = Category::find($id)->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'name_kr' => $request->name_kr,
                'main_category_id' => null,
                'photo'=>$fileName,
                'slug'=>$slug,
            ]);
        }else{
            $category = Category::find($id)->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'name_kr' => $request->name_kr,
                'main_category_id' => $request->main_category_id,
                'photo'=>$fileName,
                'slug'=>$slug,
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}

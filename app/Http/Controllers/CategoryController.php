<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Category;
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
        $search = $request->input('search', '');

        $categories = Category::where('name_uz','LIKE','%'.$search.'%')->where('deleted_at',null)->orderBy('id', 'DESC')->paginate(10);
        $categories->appends(request()->query());
        return view('pages.categories.index',compact('categories','search'));
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
            'photo'=>'required'
        ]);
        
        $file = $request->file('photo');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/categories'), $fileName);

        // slug
        $slug = Str::slug($request->name_uz);
        $count = Category::where('company_id',auth()->user()->company->first()->id)->where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;

        if($request->main_category_id=="none"){
            $category=new Category;
            $category->user_id =  auth()->user()->id;
            $category->company_id =  auth()->user()->company->first()->id;
            $category->name_uz =  $request->name_uz;
            $category->name_ru =  $request->name_ru;
            $category->name_kr =  $request->name_kr;
            $category->photo =  $fileName;
            $category->main_category_id =  null;
            $category->slug= $slug;
            $category->save();
            
            // event(new AttachmentEvent($request->photo, $category->icon(), 'categories'));
        }else{
            $category=new Category;
            $category->user_id =  auth()->user()->id;
            $category->company_id =  auth()->user()->company->first()->id;
            $category->name_uz =  $request->name_uz;
            $category->name_ru =  $request->name_ru;
            $category->name_kr =  $request->name_kr;
            $category->photo =  $fileName;
            $category->main_category_id =  $request->main_category_id;
            // $category->slug= $slug;
            $category->save();
            // event(new AttachmentEvent($request->photo, $category->icon(), 'categories'));
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $search = $request->input('search', '');
        
        $products = Product::where('name_uz','LIKE','%'.$search.'%')->where('category_id',$id)->where('deleted_at',null)->orderBy('id', 'DESC')->paginate(10);
        $products->appends(request()->query());
        $category = Category::where('id',$id)->where('deleted_at',null)->orderBy('id', 'DESC')->first();
        $categories = Category::where('deleted_at',null)->orderBy('id', 'DESC')->get();
        $units=Unit::all();
        return view('pages.categories.show',compact('products','categories','category','units','search'));
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
        
        $file = $request->file('photo');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/categories'), $fileName);

        // slug
        // $slug = Str::slug($request->name_kr);
        // $count = Category::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
        // $slug = $count ? "{$slug}-{$count}" : $slug;

        if($request->main_category_id=="none"){
            $category = Category::find($id)->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'name_kr' => $request->name_kr,
                'main_category_id' => null,
                'photo'=>$fileName,
            ]);
        }else{
            $category = Category::find($id)->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'name_kr' => $request->name_kr,
                'main_category_id' => $request->main_category_id,
                'photo'=>$fileName,
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

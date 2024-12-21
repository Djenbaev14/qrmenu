<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductParameter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
   }
    public function index(Request $request)
    {
        $company_id=auth()->user()->company->id;
        
        $search = $request->input('search', '');
        $products = Product::where('company_id',$company_id)->where('name_uz','LIKE','%'.$search.'%')->where('name_uz','LIKE','%'.$search.'%')->where('deleted_at',null)->orderBy('id', 'DESC')->paginate(20);
        $products->appends(request()->query());
        $categories = Category::where('company_id',$company_id)->where('deleted_at',null)->orderBy('id', 'DESC')->get();
        $units=Unit::all();
        return view('pages.products.index',compact('products','categories','units','search'));
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_uz'=>'required|string|max:255',
            'name_ru'=>'required|string|max:255',
            'name_kr'=>'required|string|max:255',
            'sequence_number'=>'required',
            'category_id'=>'required|exists:categories,id',
        ]);
        $photos=[];
        for ($i=0; $i < count($request->photos); $i++) { 
            if($request->photos[$i]){
                // upload image
                $photo = $request->photos[$i];
                $photoName = time().$i.'.'.$photo->getClientOriginalExtension();
                $photo->move(public_path('images/products'), $photoName);
                array_push($photos,$photoName);
            }
        }
        
        $slug = Str::slug($request->name_uz);
        $count = Product::where('company_id',auth()->user()->company->first()->id)->where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;
        $product=Product::create([
            'user_id'=>auth()->user()->id,
            'company_id'=>Company::where('user_id',auth()->user()->id)->first()->id,
            'category_id'=>$request->category_id,
            'name_uz'=>$request->name_uz,
            'name_ru'=>$request->name_ru,
            'name_kr'=>$request->name_kr,
            'description_uz'=>$request->description_uz,
            'description_ru'=>$request->description_ru,
            'description_kr'=>$request->description_kr,
            'slug'=>$slug,
            'parameter_name'=>$request->characteristic_name,
            'sequence_number'=>$request->sequence_number,
            'price'=>$request->price,
            'unit_id'=>is_numeric($request->unit_id) ? $request->unit_id : null , 
            'photos'=>$photos
            ]);
            if($request->has('is_parameter') && $request->is_parameter == 1){
                for ($i=0; $i < count($request->characteristic_names); $i++) { 
                    ProductParameter::create([
                        'user_id'=>auth()->user()->id,
                        'product_id'=>$product->id,
                        'name'=>$request->characteristic_names[$i],
                        'price'=>$request->prices[$i],
                    ]);
                }
            }
        return redirect()->route('products.index')
            ->with('success', 'The product was successfully created');
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
        $company_id=auth()->user()->company->id;
        if(Product::where('id',$id)->where('company_id',$company_id)->exists()){
            $product = Product::find($id);
            $categories = Category::where('deleted_at',null)->orderBy('id', 'DESC')->get();
            $units=Unit::all();
            return view('pages.products.edit',compact('product','categories','units'));
        }else{
            return redirect()->route('products.index')->with('error','Product not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_uz'=>'required|string|max:255',
            'name_ru'=>'required|string|max:255',
            'name_kr'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
        ]);
        $product = Product::find($id);
        $keys=array_keys($product->photos);
        $req_keys=array_keys($request->photos);
        $photos=[];

        if($request->hasFile('photos') ){
            foreach ($request->photos as $key => $photo) {
                if(in_array($key,$keys)){
                    if(file_exists(public_path('images/products/' . $product->photos[$key]))){
                        unlink(public_path('images/products/' . $product->photos[$key]));
                    }
                }
            }
        }
        if($request->hasFile('photos') ){
            for ($i=0; $i < 4; $i++) { 
                if(in_array($i,$req_keys)){
                    $photo = $request->photos[$i];
                    $photoName = time().$i.'.'.$photo->getClientOriginalExtension();
                    $photo->move(public_path('images/products'), $photoName);
                    $photos[$i] = $photoName;
                }elseif(in_array($i,$keys) && !in_array($i,$req_keys)){
                    $photos[$i] = $product->photos[$i];
                }
            }
        }
                $product->update([
                    'name_uz'=>$request->name_uz,
                    'name_ru'=>$request->name_ru,
                    'name_kr'=>$request->name_kr,
                    'category_id'=>$request->category_id,
                    'price'=>$request->price,
                    'unit_id'=>is_numeric($request->unit_id) ? $request->unit_id : null , 
                    'description_uz'=>$request->description_uz,
                    'description_ru'=>$request->description_ru,
                    'description_kr'=>$request->description_kr,
                    'photos'=>$photos,
                    ]);
                    return redirect()->route('products.index')->with('success','Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function isActive(Request $request){
        $product = Product::find($request->id);
        if ($product) {
            $product->is_active = $request->is_active;
            $product->save();

            return response()->json(['message' => 'Status muvaffaqiyatli yangilandi']);
        }

        return response()->json(['message' => 'Foydalanuvchi topilmadi'], 404);
    }
    public function importPdf(Request $request)
    {

        Excel::import(new ProductImport, $request->file('file'));

        return redirect()->back()->with('success', 'Ma\'lumotlar muvaffaqiyatli import qilindi!');
    }
}

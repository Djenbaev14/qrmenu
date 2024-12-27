<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        // $this->middleware(['permission:company-list|company-edit|company-delete|company-create']);
    }
    public function index(Request $request)
    {
        // request search
        $search = $request->input('search');
        $companies=Company::where('name', 'like', '%' . $search . '%')->where('deleted_at',null)->orderBy('id','desc')->paginate(20);
        return view('pages.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request->all();
        $request->validate([
            'name' => 'required',
            'telephone' => 'required',
        ]);
            $slug = Str::slug($request->name);
            $count = Company::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
            $slug = $count ? "{$slug}-{$count}" : $slug;

            if(Company::where('user_id',auth()->user()->id)->exists()){
                $company = Company::where('user_id',auth()->user()->id)->first();

                if($request->hasFile('logo')){
                    if(!empty($company->logo) && file_exists(public_path('images/company-logo/' . $company->logo))){
                        unlink(public_path('images/company-logo/' . $company->logo));
                    }
                    $file = $request->file('logo');
                    $fileName = 'logo-'.time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('images/company-logo'), $fileName);
                }else{
                    $fileName = $company->logo;
                }

                if($request->hasFile('banner_image')){
                    if(!empty($company->banner_image) &&  file_exists(public_path('images/banner/' . $company->banner_image))){
                        unlink(public_path('images/banner/' . $company->banner_image));
                    }
                    $file_banner = $request->file('banner_image');
                    $fileName_banner = 'banner-'.time().'.'.$file_banner->getClientOriginalExtension();
                    $file_banner->move(public_path('images/banner'), $fileName_banner);
                }else{
                    $fileName_banner = $company->banner_image;
                }

                $company->update([
                    'name'=>$request->name,
                    'slug'=>$slug,
                    'banner_image'=>$fileName_banner,
                    'logo'=>$fileName,
                    'telephone'=>$request->telephone,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,
                    'address'=>$request->address,
                ]);
                return redirect()->back()->with('success','Company updated successfully');
            }else{
                $file_banner = $request->file('banner_image');
                $fileName_banner = time().'.'.$file_banner->getClientOriginalExtension();
                $file_banner->move(public_path('images/banner'), $fileName_banner);
                
                $file = $request->file('logo');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/company-logo'), $fileName);

                $company=Company::create([
                    'user_id' => auth()->user()->id,
                    'name'=>$request->name,
                    'slug'=>$slug,
                    'banner_image'=>$fileName_banner,
                    'telephone'=>$request->telephone,
                    'logo'=>$fileName,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,     
                    'address'=>$request->address,
                ]);
                return redirect()->back()->with('success','Company created successfully');
            }
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
        $company=Company::find($id);
        return view('pages.companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'telephones' => 'required|array',
        ]);
            
        
            // slug
            $slug = Str::slug($request->name);
            $count = Company::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
            $slug = $count ? "{$slug}-{$count}" : $slug;
            $company = Company::find($id);

            if($request->hasFile('logo')){
                if(!empty($company->logo) && file_exists(public_path('images/company-logo/' . $company->logo))){
                    unlink(public_path('images/company-logo/' . $company->logo));
                }
                $file = $request->file('logo');
                $fileName = 'logo-'.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/company-logo'), $fileName);
            }else{
                $fileName = $company->logo;
            }

            if($request->hasFile('banner_image')){
                if(!empty($company->banner_image) &&  file_exists(public_path('images/banner/' . $company->banner_image))){
                    unlink(public_path('images/banner/' . $company->banner_image));
                }
                $file_banner = $request->file('banner_image');
                $fileName_banner = 'banner-'.time().'.'.$file_banner->getClientOriginalExtension();
                $file_banner->move(public_path('images/banner'), $fileName_banner);
            }else{
                $fileName_banner = $company->banner_image;
            }

            $company->update([
                'name'=>$request->name,
                'slug'=>$slug,
                'description_uz'=>$request->description_uz,
                'description_ru'=>$request->description_ru,
                'description_kr'=>$request->description_kr,
                'banner_text_uz'=>$request->banner_text_uz,
                'banner_text_ru'=>$request->banner_text_ru,
                'banner_text_kr'=>$request->banner_text_kr,
                'banner_image'=>"/images/banner/".$fileName_banner,
                'logo'=>"/images/company-logo/".$fileName,
                'telephones'=>$request->telephones,
                'instagram'=>$request->instagram,
                'telegram'=>$request->telegram,
                'facebook'=>$request->facebook,
                'youtube'=>$request->youtube,
                'address'=>$request->address,
            ]);
            return redirect()->route('companies.index')->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function key(Request $request,User $user){
        Auth::logout();
        Auth::login($user);

        return redirect()->route('home');
    }
}

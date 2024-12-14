<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['permission:setting-list|setting-edit|setting-delete|setting-create']);
    // }
    public function index()
    {
        $company = Company::where('deleted_at',null)->where('user_id',auth()->user()->id)->first();
        return view('pages.settings.index',compact('company'));
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

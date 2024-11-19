<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function __construct(){
        // $this->middleware(['permission:company-list|company-edit|company-delete|company-create']);
        $this->middleware('check.role:Admin');
    }
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
        // return $request->file('banner_image');
        $request->validate([
            'name' => 'required',
            'telephones' => 'required|array',
        ]);
            
        
            // slug
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
                    'description_uz'=>$request->description_uz,
                    'description_ru'=>$request->description_ru,
                    'description_kr'=>$request->description_kr,
                    'banner_text_uz'=>$request->banner_text_uz,
                    'banner_text_ru'=>$request->banner_text_ru,
                    'banner_text_kr'=>$request->banner_text_kr,
                    'banner_image'=>$fileName_banner,
                    'logo'=>$fileName,
                    'telephones'=>$request->telephones,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,
                    'facebook'=>$request->facebook,
                    'youtube'=>$request->youtube,
                    'address'=>$request->address,
                ]);
                return redirect()->route('settings.index')->with('success','Company updated successfully');
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
                    'description_uz'=>$request->description_uz,
                    'description_ru'=>$request->description_ru,
                    'description_kr'=>$request->description_kr,
                    'banner_text_uz'=>$request->banner_text_uz,
                    'banner_text_ru'=>$request->banner_text_ru,
                    'banner_text_kr'=>$request->banner_text_kr,
                    'banner_image'=>$fileName_banner,
                    'telephones'=>json_encode($request->telephones),
                    'logo'=>$fileName,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,
                    'facebook'=>$request->facebook,
                    'youtube'=>$request->youtube,       
                    'address'=>$request->address,
                ]);
                // event(new AttachmentEvent($request->file('logo'), $company->icon(), 'companies'));
                return redirect()->route('settings.index')->with('success','Company created successfully');
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

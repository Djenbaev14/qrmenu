<?php

namespace App\Http\Controllers;

use App\Events\AttachmentEvent;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::where('deleted_at',null)->where('user_id',auth()->user()->id)->first();
        if($company){
            $company->telephones = json_decode($company->telephones);
        }
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
            'telephones' => 'required|array',
        ]);
            
            $file = $request->file('logo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/company-logo'), $fileName);
            
            // slug
            $slug = Str::slug($request->name);
            $count = Company::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
            $slug = $count ? "{$slug}-{$count}" : $slug;

            if(Company::where('user_id',auth()->user()->id)->exists()){
                $company=Company::where('user_id',auth()->user()->id)->first();
                $company->update([
                    'name'=>$request->name,
                    'slug'=>$slug,
                    'description_uz'=>$request->description_uz,
                    'description_ru'=>$request->description_ru,
                    'description_kr'=>$request->description_kr,
                    'telephones'=>json_encode($request->telephones),
                    'logo'=>$fileName,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,
                    'address'=>$request->address,
                ]);
                event(new AttachmentEvent($request->file('logo'), $company->icon(), 'companies'));
                return redirect()->route('settings.index')->with('success','Company updated successfully');
            }else{
                $company=Company::create([
                    'user_id' => auth()->user()->id,
                    'name'=>$request->name,
                    'slug'=>$slug,
                    'description_uz'=>$request->description_uz,
                    'description_ru'=>$request->description_ru,
                    'description_kr'=>$request->description_kr,
                    'telephones'=>json_encode($request->telephones),
                    'logo'=>$fileName,
                    'instagram'=>$request->instagram,
                    'telegram'=>$request->telegram,
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

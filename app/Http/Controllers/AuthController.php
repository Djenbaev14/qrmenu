<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);
        if (!auth()->attempt($credentials)) {
            return redirect()->back()->with('error','Invalid login credentials');
        }

        return redirect()->route('home')->with('success','Success');
        
    }
    // register
    public function registerPage(){
        return view('auth.register');
    }
    public function register(Request $request){
        $credentials = $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'phone' => 'required|unique:users,phone,'.$request->phone,
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        
        $user=User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ])->assignRole('Admin');

        
        $slug = Str::slug($request->company_name);
        $count = Company::where('deleted_at','!=',null)->where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;

        Company::create([
            'user_id'=>$user->id,
            'name'=>$request->company_name,
            'slug'=>$slug
        ]);
        // auth
        auth()->login($user);
        return redirect()->route('settings.index')->with('success','Success');
    }

    
    // logout
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}

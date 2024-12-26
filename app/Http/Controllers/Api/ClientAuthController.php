<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:clients,phone,'.$request->phone,
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = Client::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = $client->createToken('ClientAppToken')->plainTextToken;

        return response()->json([
            'message' => 'Mijoz muvaffaqiyatli ro‘yxatdan o‘tdi',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],201);
    }
    public function login(Request $request){
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);
    
        $client = Client::where('phone', $request->phone)->first();
    
        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $client->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'npp'       => 'required|min:6|unique:users'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'npp'       => $request->npp,
            'password'  => bcrypt($request->password)
        ]);
    
        if($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,  
            ], 201);
        }
    
        return response()->json([
            'success' => false,
        ], 409);
    }
}

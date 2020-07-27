<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){
    	//echo json_encode($request->all());exit;

    	$credentials = $request->only('email', 'password');

    	//echo json_encode($user);exit;
    	if(Auth::attempt($credentials)){
    		$token = Str::random(80);
	    	Auth::user()->api_token = $token;
	    	Auth::user()->save();
	    	return response()->json(['token' => $token], 200);
    	}
    	return response()->json(['status' => 'Email or password is wrong'], 403);
    }
}

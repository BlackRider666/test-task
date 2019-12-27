<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Auth;
class AuthController extends Controller
{
    public function login (Request $request) {

	    $user = User::where('email', $request->email)->first();

	    if ($user) {

	        if (Auth::attempt(['email'  =>  $request->get('email'),'password' => $request->get('password')])) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            return response()->json(['token' => $token],200);
	        } else {
	            return response()->json("Password missmatch", 422);
	        }

	    } else {
	        return response()->json('User does not exist', 422);
	    }

	}
	public function logout (Request $request) {

	    $token = Auth::user()->token();
	    $token->revoke();

	    return response()->json('You have been succesfully logged out!', 200);

	}
}

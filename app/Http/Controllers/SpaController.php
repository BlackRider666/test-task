<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SpaController extends Controller
{
    public function index()
    {
    	return view('app');
    }
    public function auth_init()
    {
        $user = Auth::user();
        return response()->json(['user'=>$user],200);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email'  =>  $request->get('email'),'password' => $request->get('password')])) {
    		return response()->json(Auth::user(),200);
    	}else{
    		return response()->json(['error'=>'Invalid email or password'],401);
    	}
    }
    public function logout()
    {
    	Auth::logout();
    	return response()->json('You logout!',200);
    }
}

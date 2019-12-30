<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$http = new Client;
    	try{
    		$response = $http->post(config('services.passport.login_endpoint'),[
    			'form_params'	=> [
    				'grant_type'	=>	'password',
    				'client_id'		=>	config('services.passport.client_id'),
    				'client_secret' => config('services.passport.client_secret'),
    				'username'			  => $request->get('email'),
    				'password'		  => $request->get('password'),
    			],
    		]);
    		return $response->getBody();
    	}
    	catch(\GuzzleHttp\Exception\BadResponseException $e)
    	{
    		if($e->getCode() == 400)
    		{
    			return response()->json('Invalid Request.Please enter a username or a password!',$e->getCode());
    		}else if($e->getCode() == 401){
    			return response()->json('Your credential are incorrect. Please try again ',$e->getCode());
    		}
    	}
    }
    public function logout(Request $request)
    {
    	auth()->user()->tokens->each(function($token,$key){
    		$token->delete();
    	});
    	return response()->json('You are logout!',200);
    }
}

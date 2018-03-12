<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Session;

class TokenController extends Controller
{
	public function authenticate(Request $request)
    {
        // grab credentials from the request

        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);

        }

        return response()->json(compact('token'));
    }

    public function refresh()
    {
    	$token = JWTAuth::getToken();

    	try {
    		$token = JWTAuth::refresh($token);
    		return response()->json(['token'=>$token]);
    	} catch (Exception $e) {
    		throw new HttpResponseException(Response::json(['msg' => "Need to Login Again"]));
    	}

    }

    public function invalidate()
    {
    	$token = JWTAuth::getToken();
    	try{
    		$token = JWTAuth::invalidate($token);
    		return response()->json(['token' => $token]);
    	}catch(Exception $e)
    	{

    	}
    }

    public function test()
    {
        
    }

}
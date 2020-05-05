<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SessionController extends ResponseController
{
    /**
     * Register a new user
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //Validate param entry
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
            'confirm' => ['required', 'same:password']
        ]);
        if ($validator->fails()) {
            return $this->sendResponse('Validation Error', $validator->errors(), false, 501);
        }
        //Encrypt password
        $input['password'] = bcrypt($input['password']);
        //Save new user
        $user = User::create($input);
        //Create Token
        $response['token'] = $user->createToken('apilogin')->accessToken;
        $response['name'] = $user->name;
        //Return Token and User

        return $this->sendResponse('User Registered', $response);
    }

    /**
     * User Login
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //Try to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //Get the user data
            $user = Auth::user();
            $response['token'] = $user->createToken('apilogin')->accessToken;
            $response['name'] = $user->name;

            return $this->sendResponse('User Authenticated', $response);
        }

        return $this->sendResponse('Unauthorized Access', ['error' => 'Cannot authenticate user or password'], false, 501);
    }

    /**
     * User logout, revoke the access token
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {   
        //Check user session
        if (Auth::check()) {
            //Get User
            $user = Auth::user();
            //Get Token
            $token = $user->token();
            //Revoke Token
            $token->revoke();

            return $this->sendResponse("User logged out");
        }
        return $this->sendResponse('Unauthorized Access', ['error' => 'User has no session'], false);
    }
}

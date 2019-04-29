<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;
use App\User;

class AuthController extends Controller
{
    public function loginApi(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'email'=>'required|email',
    		'password'=>'required'
    		]);
    	if($validator->fails())
    	{
    		return Response::json(['status'=>0,'message'=>$validator->errors()->all()]);
    	}
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    	{  
    		
           
           return Response::json(['status'=>1,'message'=>'Login Success']);
    	}
    	return Response::json(['status'=>0,'message'=>'Username or Password Incorrect']);
    }
       public function  listuser()
    {
        return view('listuser');
    }
    public function showLogout()
    {
        $user=User::where('id',Auth::user()->id);
        $user->update(['status'=>'0']);

        Auth::logout();
        return view('login');
    }
    public function showadduser()
    {
        return view('adduser');
    }
    public function showaddevent()
    {
        return view('user/addevent');
    }
    public function listevent()
    {
        if(isSuperAdmin())
            return view('listevent');
        return view('user/listevent');
    }
}

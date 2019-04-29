<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Response;
use App\User;
use Auth;
use snake_case;
use Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function addUserApi(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'name'=>'required',
    		'mob_no'=>'required|unique:users,phone_no',
    		'email'=>'required|email|unique:users,email',
    		'password'=>'required',
    		]);
    	if($validator->fails())
    	{
    		return Response::json(['status'=>0,'message'=>$validator->errors()->all()]);
    	}
    	$user=new User();
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->phone_no=$request->mob_no;
    	$user->password=Hash::make($request->password);
        $user->created_by=Auth::user()->id;
        $user->status="0";
    	$user->save();
    	return Response::json(['status'=>1,'message'=>'User Added Success Makkalae...']);
    }

}

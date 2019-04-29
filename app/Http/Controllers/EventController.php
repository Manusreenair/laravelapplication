<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Auth;
use App\Event;
use snake_case;

class EventController extends Controller
{
  public function __construct()
  {
  	$this->middleware('auth');
  }  
  public function addEventApi(Request $request)
  {
  	$validator=Validator::make($request->all(),[
  		'title'=>'required|unique:events,title',
  		'description'=>'required',
  		'start_date'=>'required',
  		'end_date'=>'required',
  		'venue'=>'required',
  		]);
  	if($validator->fails())
  	{
  		return Response::json(['status'=>0,'message'=>$validator->errors()->all()]);
  	}
  	$event=new Event();
  	$event->title=$request->title;
  	$event->description=$request->description;
  	$event->start_date=$request->start_date;
  	$event->end_date=$request->end_date;
  	$event->venue=$request->venue;
  	$event->users_id=Auth::user()->id;
  	$event->save();
  	return Response::json(['status'=>1,'message'=>'Event Added Successfully']);

  }
}

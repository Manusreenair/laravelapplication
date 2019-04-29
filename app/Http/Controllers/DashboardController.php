<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function showDashboard()
    {
    	if(isSuperAdmin())
    	{
            return view('superadmin_dash');
    	}
        else
        {
            
            return view('user/user_dash');
        }
    }
}

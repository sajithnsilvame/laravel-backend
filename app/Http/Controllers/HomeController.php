<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {   
        if(Auth::id()){
            $usertype = Auth::User()->user_type;
            if($usertype == 1){
                return view('admin.components.index');
            }
            else{
                Auth::logout();
                Session::flush();
                return view('admin.pages.404');
            }
        }
        else{
            return redirect('auth.login');
        }
        
        
    }
}

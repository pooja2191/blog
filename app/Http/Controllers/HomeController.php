<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       //echo"<pre>"; print_r(\Illuminate\Support\Facades\Auth::user()->role);exit;
	    $bloglist = Blog::where('is_active',true)->where('end_date','>=',date('Y-m-d'))->get();
        return view('welcome',compact('bloglist'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\verifymail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function index()
    {
        return view('home');
    }

    public function mail(){
        if(verify_mail('newuser@example.com')) {
            return r_reditrect(route('home'));
        }
        return r_backerror();
    }
}

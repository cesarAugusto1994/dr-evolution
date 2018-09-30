<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$user = $request->user();

        $route = 'home_company';

        if ($user->hasRole('admin')) {
          $route = 'home_admin';
        }

        return redirect()->route($route);*/

        return view('home');
    }
}

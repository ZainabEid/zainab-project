<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    } //end of construct
   
    public function index()
    {
        return view('admin.dashboard.index');
        
    }// end of index

    public function changeLanguage($lang)
    {
        app()->setLocale($lang);
        session()->put('locale',$lang);

        return redirect()->back();

    }//end of change language

  

    
}// end of dashboard controller

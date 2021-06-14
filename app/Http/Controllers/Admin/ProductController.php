<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth');
    }
   
    public function index()
    {
        return view('admin.dashboard.products.index');
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}

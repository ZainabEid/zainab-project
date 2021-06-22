<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
   
    // show all categories
    public function index()
    {
        // dd(session()->get('cart'));
        $categories = Category::all();
        return view('site.index',compact('categories'));
    }// end of index


    // show shop page
    public function shop()
    {
        $products = Product::all();

        $cart = session()->get('cart');
        if (isset($cart)){
            return view('site.shop',compact('products','cart'));
        } 
        
        return view('site.shop',compact('products'));
    }// end of shop



    // show the entire category
    public function showCategory(Category $category)
    {
        return view('site.showCategory', compact('category'));
    }// end of show category


   

    
}

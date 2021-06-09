<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

     /** constructor: setting middlewares */
     public function __construct()
     {
         $this->middleware('admin.auth:admin');
            
     }

    public function index()
    {
        $categories = Category::all();
        return view('admin.dashboard.categories.index', compact('categories'));
    } // end of index


    public function create()
    {

        return view('admin.dashboard.categories.create');
    } //end of create


    public function store(CategoryRequest $request)
    {
        $requested_data = $request->except(['photo', '_token']);

        // manage image uploading
        save_image('categories', $request->photo );
                //$request->photo->store('uploads','public');

        $requested_data['photo'] = $request->photo->hashName();

        Category::create($requested_data);

        // session()->flash('success', __('site.added-successfuly'));

        return redirect()->route('admin.categories.index');
    } // end store


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('admin.dashboard.categories.edit', compact('category'));
    } // end edit


    public function update(CategoryRequest $request, Category $category)
    {
        $requested_data =  $request->except(['_token', '_method', 'photo']);

        if ($request->photo) {

           delete_image('categories',$category->photo);
          save_image('categories' , $request->photo);

            $requested_data['photo'] = $request->photo->hashName();
        }

        $category->update($requested_data);
        // session()->flash('success', __('site.updated-successfuly'));
        return redirect()->route('admin.categories.index');
    }


    public function destroy(Category $category)
    {
        // helper function delete image if exist
        delete_image('categories', $category->photo);

       $category->delete();

       return redirect()->route('admin.categories.index');
       // session()->flash('success', __('site.deleted-successfuly'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $news;

    public function __construct(NewsRepositoryInterface $news)
    {
        $this->middleware('admin.auth:admin');

       // set the news
       $this->news = $news;

    }


    public function index()
    {
        $news = $this->news->all();
        return view('admin.dashboard.news.index',compact('news'));
    }

   
    public function create()
    {
       return view('admin.dashboard.news.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description' => 'required',
            'photo' => 'required|image',

        ]);
        $requested_data = $request->except('photo','_token' ,'method');

       save_image('news', $request->photo);

       $requested_data['photo' ] = $request->photo->hashName();


        $this->news->create($requested_data);
        return redirect()->route('admin.news.index');
    }

    
    public function show(News $news)
    {
       // return $this->news->show($news);
    }

  
    public function edit(News $news)
    {
        return view('admin.dashboard.news.edit', compact('news'));

    }

  
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description' => 'required',
            'photo' => 'sometimes|required|image',

        ]);

        // handling photo
        if($request->photo){
           delete_image('news', $news->photo);
           save_image('news', $news->photo);
            $request->photo = $request->photo->hashName();
        }

       // dd($request->all());

        $this->news->update($request->all(), $news);
        return redirect()->route('admin.news.index');

    }

   
    public function destroy(News $news)
    {
        delete_image('news', $news->photo);
        $this->news->delete($news);
        return redirect()->back();
    }
}

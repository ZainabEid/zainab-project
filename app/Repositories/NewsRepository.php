<?php 
namespace App\Repositories;

use App\Models\Admin;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    // news property on class instances
    protected $news;

    // Constructor to bind news to repo
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    // Get all instances of news
    public function all()
    {
        return $this->news->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        $admin = Admin :: findOrFail(auth()->guard('admin')->user()->id);

        return $admin->news()->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->news->find($id)->first();
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        $record = $this->news->find($id)->first();
        return $record->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->news->findOrFail($id);
    }

    // Get the associated news
    public function getNews()
    {
        return $this->news;
    }

    // Set the associated news
    public function setNews($news)
    {
        $this->news = $news;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->news->with($relations);
    }
}
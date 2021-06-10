<?php 
namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    // news property on class instances
    protected $news;

    // Constructor to bind news to repo
    public function __construct(News $news)
    {
        $this->news = $news;
    }

     // Get all instances of model
     public function all()
     {
         return $this->news->all();
     }

   
    // create a new record in the database
    public function create(array $data)
    {
        $admin = Admin :: findOrFail( auth()->guard('admin')->user()->id );

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

  
}
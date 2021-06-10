<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\NewsRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
       

    }

   
    public function boot()
    {
        $this->app->bind(EloquentRepositoryInterface::class , BaseRepository::class);
        $this->app->bind(NewsRepositoryInterface::class ,NewsRepository::class);        
    }
}

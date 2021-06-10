<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all();

    public function findById(
        int $modelId,
        array $colums = ['*'],
        array $relations = [],
        array $appends = []
     );

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
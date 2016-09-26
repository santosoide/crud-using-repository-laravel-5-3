<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Crudable;

abstract class AbstractRepository  implements Crudable {

    protected $model;

    protected $with = [];

    public function load(array $with)
    {
        $this->with = $with;
        return $this;
    }

    public function make()
    {
        return $this->model->with($this->with);
    }

    public function all(array $columns = ['*'])
    {
        return $this->make()->get($columns);
    }

    public function paginate($limit = 15, array $columns = ['*'])
    {
        return $this->make()->paginate($limit, $columns);
    }

    public function create(array $data){}

    public function show($id){}

    public function update($id, array $data){}

    public function destroy($id){}
}
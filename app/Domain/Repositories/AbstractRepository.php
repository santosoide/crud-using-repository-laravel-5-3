<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Crudable as Crudable;

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

      public function paginate($limit = 10, $page = 1, array $columns = ['*'], $key, $value = '')
    {
        return $this->make()->where($key, 'like', '%' . $value . '%')->paginate($limit, $columns);
    }


     public function create(array $data)
    {
        return $this->model->create($data);
    }



     public function update($id, array $data)
    {
        $q = $this->findById($id)->fill($data)->save();

        if (!$q) {
            return 'Tidak berhasil update data';
        }

        return 'Berhasil update data';

    }


     public function delete($id)
    {
        $q = $this->findById($id);

        if (!$q) {
            return 'Gagal Hapus data';
        }
        $q->delete();

        return 'Berhasil Hapus data';
    }

}
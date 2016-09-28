<?php
namespace App\Domain\Contracts;


interface Crudable
{

    public function findById($id);
    
    public function paginate($limit = 10, $page = 1, array $column, $field, $search = '');

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

}
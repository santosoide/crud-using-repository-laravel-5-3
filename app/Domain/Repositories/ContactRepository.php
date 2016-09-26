<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Contact;
use App\Domain\Contracts\ContactInterface;
use App\Domain\Contracts\Crudable;

class ContactRepository extends AbstractRepository implements ContactInterface, CrudableInterface {

    protected $model;

    public function __construct(Contact $contact){
        $this->model = $contact;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function paginate($limit = 15, array $columns){
        return parent::paginate($limit, $columns);
    }

    public function findById($id){
        return $this->model->find($id);
    }

}
<?php

namespace App\Http\Controllers;

use App\Domain\Contracts\ContactInterface;

class ContactController extends Controller {

    protected $contact;

    public function __construct(ContactInterface $contact){
        $this->contact = $contact;
    } 

    public function index(){
        return $this->contact->getAll();
    }

    public function show($id){
        return $this->contact->findById($id);
    }

    public function store(){}

    public function update($id){}

    public function destroy($id){}

}
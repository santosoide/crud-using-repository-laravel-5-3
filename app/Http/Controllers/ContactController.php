<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactCreateRequest;
use App\Http\Requests\Contact\ContactEditRequest;
use App\Domain\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Domain\Contracts\ContactInterface;

class ContactController extends Controller {

    protected $contact;

    public function __construct(ContactInterface $contact){
        $this->contact = $contact;
    } 

    public function index(Request  $request){
        return $this->contact->paginate(10, $request->input('page'), $column = ['*'], '', $request->input('search'));
    }

    public function show($id){
        return $this->contact->findById($id);
    }

    public function store(ContactCreateRequest $request)
    {
        return $this->contact->create($request->all());
    }

    public function update(ContactEditRequest $request, $id){
        return $this->contact->update($id, $request->all());
    }

    public function destroy($id){
        return $this->contact->delete($id);
    }

}
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

    /**
     * @api {get} api/contacts Request Contact with Paginate
     * @apiName GetContactWithPaginate
     * @apiGroup Contact
     *
     * @apiParam {Number} page Paginate contact list
     */
    public function index(Request  $request){
        return $this->contact->paginate(10, $request->input('page'), $column = ['*'], '', $request->input('search'));
    }

/**
     * @api {get} api/contacts/id Request Show Contact by ID
     * @apiName ShowContactByID
     * @apiGroup Contact
     *
     * @apiParam {Number} id id_contact
     * @apiParam {Varchar} name name of contact
     * @apiParam {Varchar} email email of contact
     * @apiParam {Float} phone phone of contact
     * @apiParam {Number} id id of contact
     */
    public function show($id){
        return $this->contact->findById($id);
    }

/**
     * @api {post} api/contacts/ Request Post Contact
     * @apiName PostContact
     * @apiGroup Contact
     *
     * @apiParam {Number} id id_contact
     * @apiParam {Varchar} examplename name of contact
     * @apiParam {Varchar} exampleemail email of contact
     * @apiParam {Float} examplephone phone of contact
     * @apiSuccess Return-Array-Contact Store was success
     * 
     */
    public function store(ContactCreateRequest $request)
    {
        return $this->contact->create($request->all());
    }
/**
     * @api {put} api/contacts/id?name=examplename&email=exampleemail&address=exampleaddress&phone=examplephone Request Update Contact by ID
     * @apiName UpdateContactByID
     * @apiGroup Contact
     *
     * @apiParam {Number} id id_contact
     * @apiParam {Varchar} examplename name of contact
     * @apiParam {Varchar} exampleemail email of contact
     * @apiParam {Float} examplephone phone of contact
     * @apiSuccess Berhasil-Update-Data Update was success
     * @apiError Tidak-Berhasil-update-data Update was failed
     */
    public function update(ContactEditRequest $request, $id){
        return $this->contact->update($id, $request->all());
    }

/**
     * @api {delete} api/contacts/id Request Delete Contact by ID
     * @apiName DeleteContactByID
     * @apiGroup Contact
     *
     * @apiParam {Number} id id of contact
     * @apiSuccess Berhasil-Hapus-Data id was correct 
     * @apiError Gagal-Hapus-Data id was not found
     */
    public function destroy($id){
        return $this->contact->delete($id);
    }

}
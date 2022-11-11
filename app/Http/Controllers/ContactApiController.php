<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;

class ContactApiController extends Controller
{
    public function getSepupuLaki()
    {
        return ContactResource::collection(Contact::where([
            ['status', '<>', 'anak'],
            ['status', '<>', 'bapak'],
            ['gender', 'L']
        ])->get()); //Select * from contact where status != 'anak' and status != 'bapak' and gender = L
    }

    public function getBibi()
    {
        return ContactResource::collection(Contact::where([
            ['status', 'anak'],
            ['gender', 'P']
        ])->get());
    }

    public function getCucuPerempuanBudi()
    {
        return ContactResource::collection(Contact::where([
            ['status', '<>', 'anak'],
            ['status', '<>', 'bapak'],
            ['gender', 'P']
        ])->get());
    }
    public function getCucuBudi()
    {
        return ContactResource::collection(Contact::where('status', '<>', 'anak')->where('status', '<>', 'bapak')->get());
    }

    public function getAnakBudi()
    {
        return ContactResource::collection(Contact::where('status', 'anak')->get());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactService $contactService)
    {
        return $contactService->treeSilsilah();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        return new ContactResource(Contact::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
        return  new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->noContent();
    }
}

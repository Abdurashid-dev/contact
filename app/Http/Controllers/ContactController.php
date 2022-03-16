<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory
     *
     */
    public function index()
    {
        $contacts = Contact::with('emails', 'phones')->paginate(10);
        return view('admin.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
        ]);
        if ($request->emails) {
            foreach ($request->emails as $email) {
                Email::create([
                    'email' => $email,
                    'contact_id' => $contact->id,
                ]);
            }
        }
        if ($request->phones) {
            foreach ($request->phones as $phone) {
                Phone::create([
                    'phone' => $phone,
                    'contact_id' => $contact->id,
                ]);
            }
        }
        return redirect()->route('admin.contact.index')->with('success', 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $contact = Contact::with('emails', 'phones')->findOrFail($contact->id);
//        dd($contact->emails);
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactRequest $request, $contact)
    {
//        dd($request);
        $contact = Contact::with('emails', 'phones')->findOrFail($contact);
        $contact->update([
            'name' => $request->name,
        ]);
        if ($request->emails) {
            foreach ($request->emails as $email) {
                Email::create([
                    'email' => $email,
                    'contact_id' => $contact->id,
                ]);
            }
        }
        if ($request->phones) {
            foreach ($request->phones as $phone) {
                Phone::create([
                    'phone' => $phone,
                    'contact_id' => $contact->id,
                ]);
            }
        }
        return redirect()->route('admin.contact.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        foreach ($contact->emails as $email) {
            $email->delete();
        }
        foreach ($contact->phones as $phone) {
            $phone->delete();
        }
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact deleted successfully!');
    }
}

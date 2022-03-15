<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
//        dd($this->all());
        if (isset($this->id)){
            $contact = Contact::with('emails', 'phones')->findOrFail($this->id);
//            dd($contact->emails->first()->email);
            return [
                'name' => 'required|string|max:255',
//                'emails' => ['required', 'max:255', 'unique:emails,email'.$contact->emails->first()->id],
                    'emails.*' => ['required', 'max:255',
                        Rule::unique('emails')->ignore($contact->emails->first()->id)
                            ->where(function ($query) {
                                $query->where('contact_id', $this->id);
                            })
                        ],
//                'phones' => ['required', 'max:255', 'unique:phones,phone'.$contact->phones->first()->id],
//                'phones.*' => ['required', 'max:255', 'unique:phones, phone, '.$contact->phones->first()->email],
            ];
        }else{
            return [
                'name' => 'required|string|max:255',
//                'emails' => ['required', 'max:255', 'unique:emails,email'],
                'emails.*' => ['required', 'max:255', 'unique:emails,email'],
//                'phones' => ['required', 'min:10', 'max:255', 'unique:phones,phone'],
                'phones.*' => ['required', 'min:10', 'max:255', 'unique:phones,phone'],
            ];
        }
    }
}

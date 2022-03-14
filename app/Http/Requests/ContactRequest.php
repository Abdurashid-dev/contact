<?php

namespace App\Http\Requests;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use App\Rules\EmailValidation;
use App\Rules\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

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
        $contact = Contact::with('emails', 'phones')->findOrFail($this->id);
        return [
            'name' => 'required|string|max:255',
            'emails' => ['required', 'max:255', new EmailValidation(), 'unique:emails,email'.$contact->emails->first()->email],
            'phones' => ['required', 'max:255', new PhoneValidation(), 'unique:phones,phone'.$contact->phones->first()->phone],
        ];
    }
}

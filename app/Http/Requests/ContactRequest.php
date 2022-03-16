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
        if (isset($this->id)) {
            $contact = Contact::with('emails', 'phones')->find($this->id);
            foreach ($contact->emails as $email){
                $email = Email::findOrFail($email->id);
                $email->delete();
            }
            foreach ($contact->phones as $phone){
                $phone = Phone::findOrFail($phone->id);
                $phone->delete();
            }
            return [
                'name' => 'required|string|max:255',
                'emails' => ['required', 'max:255', new EmailValidation()],
                'phones' => ['required', 'max:255', new PhoneValidation()],
            ];
        } else {
            return [
                'name' => 'required|string|max:255',
                'emails.*' => ['required', 'max:255', 'unique:emails,email'],
                'phones.*' => ['required', 'min:10', 'max:255', 'unique:phones'],
            ];
        }
    }
}

<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required|string|max:255',
            'emails' => ['required','max:255','unique:emails,email', new EmailValidation()],
            'phones' => ['required','max:255','unique:phones,phone', new PhoneValidation()],
        ];
    }
}

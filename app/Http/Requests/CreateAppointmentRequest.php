<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAppointmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => 'required',
            'date' => 'required',
            'contact.name' => 'required',
            'contact.surname' => 'required',
            'contact.email' => 'required',
            'contact.address' => 'required',
            'contact.phone' => 'required',
        ];
    }

    /**
     * Return specific message for every validation error
     * @return array|string[]
     */
    public function messages()
    {
        return [
            "address.required"=>"please enter the address",
            "date.required"=>"please enter the date",
            "contact.name.required"=>"please enter the contact name",
            "contact.surname.required"=>"please enter the contact surname",
            "contact.email.required"=>"please enter the contact email",
            "contact.address.required"=>"please enter the contact address",
            "contact.phone.required"=>"please enter the contact phone",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'messages' => $validator->getMessageBag()->first(),
        ], $status ?? 400,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE));
    }
}

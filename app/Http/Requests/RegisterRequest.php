<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
    /**
     * Return specific message for every validation error
     * @return array|string[]
     */
    public function messages()
    {
        return [
            "name.required"=>"please enter the name",
            "name.string"=>"name property format is incorrect",
            "name.max"=>"you reach to max length of name",
            "email.required"=>"please enter the email",
            "email.string"=>"email property format is incorrect",
            "email.email"=>"email property format is incorrect",
            "email.max"=>"you reach to max length of email",
            "email.unique"=>"there is account with this email",
            "password.required"=>"please enter the password",
            "password.string"=>"password property format is incorrect",
            "password.min"=>"The minimum password length is 8 characters",
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

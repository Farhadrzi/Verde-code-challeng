<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email',
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
            "email.required"=>"please enter the email",
            "email.string"=>"email property format is incorrect",
            "email.email"=>"email property format is incorrect",
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

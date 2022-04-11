<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'firstName' => 'required|string|max:30',
            'lastName'=> 'required|string|max:50',
            'email'=> 'required|email',
            'password'=> 'required|min:3|max:20',
            'birth'=> 'required',
        ];
    }
}

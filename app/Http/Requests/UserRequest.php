<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> 'bail|required|alpha|min:6|max:255',
            'email' => 'bail|required|unique:users|email',
            'avatar' => 'image',
            'birth_day' => 'bail|required|date',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
            'password' => 'bail|required|min:6|max:30'
        ];
    }
}

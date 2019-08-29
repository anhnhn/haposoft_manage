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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'email' => 'required|email|unique:users,email|max:255',
                    'password' => 'required|min:6',
                    'name' => 'required|max:50',
                    'address' => 'required',
                    'phone' => 'required|numeric|digits_between:10,15',
                    'department_id' => 'required|numeric',
                    'avatar' => 'image',
                    'birth_day' => 'bail|required|date'
                ];
            }
            case 'PUT':
            {
                return [
                    'email' => 'required|email|max:255|unique:users,email,' . $this->route('user'),
                    'name' => 'required|max:50',
                    'phone' => 'required|numeric|digits_between:10,15',
                    'department_id' => 'required|numeric',
                    'avatar' => 'image',
                    'birth_day' => 'bail|required|date'
                ];
            }
            case 'PATCH':
            {
                return [];
            }
            default:
                break;
        }
    }
}

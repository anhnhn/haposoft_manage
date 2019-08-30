<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
                    'name' => 'required|max:100|unique:reports,name',
                    'content' => 'required|max:1000',
                    'user_id' => 'required|numeric',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max:100|unique:reports,name,' . $this->route('report'),
                    'content' => 'required|max:1000',
                    'user_id' => 'required|numeric',
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

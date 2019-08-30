<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
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
                    'name' => 'required|max:100|unique:projects,name',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after:start_date',
                    'customer_id' => 'required|numeric',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max:100|unique:projects,name,' . $this->route('project'),
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after:start_date',
                    'customer_id' => 'required|numeric'
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
                    'name' => 'required|unique:tasks,name|max:255',
                    'content' => 'required',
                    'hours' => 'required|numeric',
                    'project_id' => 'required|numeric',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|max:255|unique:tasks,name,' . $this->route('task'),
                    'content' => 'required',
                    'hours' => 'required|numeric',
                    'project_id' => 'required|numeric',
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

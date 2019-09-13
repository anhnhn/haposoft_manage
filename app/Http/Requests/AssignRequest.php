<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
                $projectId = $this->input('project_id');
                $project = Project::findOrFail($projectId);
                $startDateProject = $project->start_date;
                $endDateProject = $project->end_date;
                return [
                    'project_id' => 'required|numeric',
                    'department_id' => 'nullable|numeric',
                    'user_id' => 'required|numeric',
                    'start_date' => 'bail|required|date|after_or_equal:' . $startDateProject,
                    'end_date' => 'bail|required|date|after_or_equal:start_date|before_or_equal:' . $endDateProject,
                ];
            }
            case 'PUT':
            {
                return [
                    'project_id' => 'numeric',
                    'start_date' => 'bail|required|date',
                    'end_date' => 'bail|required|date|after:start_date'
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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Project;
use App\Models\User;
use test\Mockery\Adapter\Phpunit\BaseClassStub;

class ProjectUserController extends Controller
{
    public function index()
    {
        $tableProjects = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->orderByDesc('id')->paginate(config('variables.paginate'));
        $projects = Project::orderBy('id', 'desc')->paginate(config('variables.paginate'));
        $data = [
            'projects' => $projects,
            'tableProjects' => $tableProjects,
        ];
        return view('admin.project_user.index', $data);
    }

    public function create()
    {
        $projects = Project::all();
        $departments = Department::all();
        $users = User::all();
        $data = [
            'projects' => $projects,
            'departments' => $departments,
            'users' => $users
        ];
        return view('admin.project_user.assign', $data);
    }

    public function store(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $project->users()->attach($request->user_id,
            [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]
        );
        $projects = Project::with(['users' => function ($query) {
        }])->findOrFail($request->project_id);
        $data = [
            'projects' => $projects,
        ];
        return response()->json($data);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->users()->detach();
        return redirect('admin.project_user.index')->with('message', __('messages.delete_message'));
    }

    public function getProjectById($projectId)
    {
        $data = [];
        if (is_numeric($projectId)) {
            $project = Project::with(['users' => function ($query) {
                $query->orderBy('name');
            }])->findOrFail($projectId);
            $data = [
                'project' => $project,
            ];
        }
        return response()->json($data);
    }

    public function destroyUser($userId, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->users()->detach($userId);
        $data = [
            'message' => 'have user',
        ];
        return response()->json($data);
    }

    public function getUserById($departmentId)
    {
        $department = Department::with(['users' => function ($query) {
            $query->orderBy('name');
        }])->findOrFail($departmentId);;
        $data = [
            'department' => $department,
            'message' => 'have user',
        ];
        return response()->json($data);
    }
}

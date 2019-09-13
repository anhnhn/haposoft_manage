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
use App\Http\Requests\AssignRequest;

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

    public function store(AssignRequest $request)
    {
        $project = Project::findOrFail($request->project_id);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $projectId = $request->project_id;
        $userId = $request->user_id;
        if ($this->checkDate($projectId, $userId, $startDate, $endDate)) {
            $project->users()->attach($userId,
                [
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]
            );
            $projects = Project::with(['users' => function ($query) {
            }])->findOrFail($projectId);
            $data = [
                'projects' => $projects,
                'message' => 'Assign successfully'
            ];
        }
        else
        {
            $data = [
                'message' => 'Time overlaps'
            ];
        }
        return response()->json($data);
    }

    public function show($id)
    {
    }

    public function editProjectUser($userId, $projectId, $startDate, $endDate)
    {
        $projects = Project::all();
        $projectUser = Project::findOrFail($projectId);
        $data = [
            'projectId' => $projectId,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'userId' => $userId,
            'projectUser' => $projectUser
        ];
        return view('admin.project_user.edit', $data);
    }

    public function update(AssignRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->users()->syncWithoutDetaching(
            [$request->user_id => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]
            ]);
        return redirect()->route('projectuser.create')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
//        $project = Project::findOrFail($id);
//        $project->users()->detach();
//        return redirect('admin.project_user.index')->with('message', __('messages.delete_message'));
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

    public function editUser($userId, $projectId, $startDate, $endDate)
    {
        $url = route('projectUser.edit', [
            'userId' => $userId,
            'projectId' => $projectId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
        $data = [
            'url' => $url
        ];
        return response()->json($data);
    }

    public function destroyUser($userId, $projectId, $startDate, $endDate)
    {
        $project = Project::findOrFail($projectId);
        $project->users()->wherePivot('user_id', $userId)->wherePivot('start_date', $startDate)->wherePivot('end_date', $endDate)->detach();
        $data = [
            'message' => 'have user',
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
        return response()->json($data);
    }

    public function checkDate($projectId, $userId, $startDate, $endDate)
    {
        $project = Project::with(['users' => function ($query) {
        }])->findOrFail($projectId);
        $data1 = collect([]);
        foreach ($project->users->where('id', $userId) as $user) {
            $data1[] = $user->pivot;
        }
        $user1 = $data1->whereBetween('start_date', [$startDate, $endDate]);
        $user2 = $data1->whereBetween('end_date', [$startDate, $endDate]);
        $data2 = collect([]);
        foreach ($data1 as $user) {
            if ($startDate > $user->start_date && $endDate < $user->end_date) {
                $data2[] = $user;
            }
            elseif($startDate < $user->start_date && $endDate > $user->end_date) {
                $data2[] = $user;
            }
        };
        if ($user1->isEmpty() && $user2->isEmpty() && $data2->isEmpty()) {
            return true;
        } else {
            return false;
        }
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

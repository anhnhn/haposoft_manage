<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderByDesc('project_id', 'desc')->paginate(config('variables.paginate'));
        $data = [ 'tasks' => $tasks ];
        return view('admin.task.index', $data);
    }

    public function create()
    {
        $projects = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->orderByDesc('id')->paginate(config('variables.paginate'));
        $data = [ 'projects' => $projects ];
        return view("admin.task.create", $data);
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getUserByProjectId($id)
    {
        $project = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->findOrFail($id);
        $data = [ 'project' => $project ];
        return response()->json($data);
    }
}

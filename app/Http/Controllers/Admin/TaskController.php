<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderByDesc('project_id', 'desc')->paginate(config('variables.paginate'));
        $data = [
            'tasks' => $tasks
        ];
        return view('admin.task.index', $data);
    }

    public function create()
    {
        $projects = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->orderByDesc('id')->paginate(config('variables.paginate'));
        $data = [
            'projects' => $projects
        ];
        return view("admin.task.create", $data);
    }

    public function store(TaskRequest $request)
    {
        if (!$request->has('user_id')) {
            $request['user_id'] = null;
        }
        $task = $request->all();
        Task::create($task);
        return redirect()->route('tasks.index')->with('message', __('messages.create_message'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $data = [
            'task' => $task
        ];
        return view('admin.task.show', $data);
    }

    public function edit($id)
    {
        $projects = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->orderByDesc('id')->paginate(config('variables.paginate'));
        $task = Task::findOrFail($id);
        $data = [
            'task' => $task,
            'projects' => $projects,
        ];
        return view('admin.task.update', $data);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->reports()->detach();
        $task->delete();
        return redirect()->route('tasks.index')->with('message', __('messages.delete_message'));
    }

    public function getUserByProjectId($id)
    {
        $project = Project::with(['users' => function ($query) {
            $query->select('user_id', 'name')->get();
        }])->findOrFail($id);
        $data = [
            'project' => $project
        ];
        return response()->json($data);
    }

    public function search(Request $request)
    {
        if($request->task_name == null)
        {
            return redirect()->route('tasks.index');
        }
        else
        {
            $task_name = $request->task_name;
            $tasks = Task::where('name', 'like', '%' . $task_name . '%')->orderByDesc('id')->paginate(config('variables.paginate'));
            $data = [
                'tasks' => $tasks,
                'taskName' => $task_name
            ];
            return view('admin.task.index', $data);
        }
    }
}

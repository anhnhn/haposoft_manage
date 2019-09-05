<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class ProjectController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $tasks = $project->tasks()->paginate(config('variables.paginate'));
        $data = [
            'project' => $project,
            'tasks' => $tasks,
        ];
        return view('user.project.show', $data);
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
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\Auth;

class
ProjectController extends Controller
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
        $user = Auth::user();
        $project = Project::findOrFail($id);
        if ($user->can('viewProjectUser', $project)) {
            $tasks = $project->tasks()->paginate(config('variables.paginate'));
            $data = [
                'project' => $project,
                'tasks' => $tasks,
            ];
            return view('user.project.show', $data);
        } else {
            return abort('401');
        }
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

    public function search(Request $request)
    {
        $projects = Project::with('customer')->where('name', 'like', '%' . $request->project_name . '%')
            ->whereHas('customer', function ($query) use ($request) {
                if (isset($request->customer_name)) {
                    $query->where('name', 'like', '%' . $request->customer_name . '%');
                }
            })->paginate(config('variables.paginate'));
        $data = [
            'projects' => $projects,
        ];
        return view('user.home', $data);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\Customer;
use App\Models\Project;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(Config('variables.paginate'));
        $data = ['projects' => $projects];
        return view('admin.project.index', $data);
    }

    public function create()
    {
        $customers = Customer::all();
        $data = [
            'customers' => $customers
        ];
        return view('admin.project.create', $data);
    }

    public function store(ProjectRequest $request)
    {
        $project = $request->all();
        Project::create($request->all());
        return redirect()->route('projects.index')->with('message', __('messages.create_message'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $data = [
            'project' => $project
        ];
        return view('admin.project.show', $data);
    }

    public function edit($id)
    {
        $customers = Customer::all();
        $project = Project::findOrFail($id);
        $data = [
            'project' => $project,
            'customers' => $customers
        ];
        return view("admin.project.update", $data);
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return redirect()->route('projects.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->users()->detach();
        $project->tasks()->delete();
        $project->delete();
        return redirect()->route('projects.index')->with('message', __('messages.delete_message'));
    }
}

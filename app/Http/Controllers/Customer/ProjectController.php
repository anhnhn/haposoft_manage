<?php

namespace App\Http\Controllers\Customer;

use App\Models\Project;
use Illuminate\Http\Request;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $customer = Auth::user();
        $projects = $customer->projects()->paginate(config('variables.paginate'));
        $data = [
            'customer' => $customer,
            'projects' => $projects,
        ];
        return view('customer.project.index', $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $customerLogin = Auth::user();
        $project = Project::findOrFail($id);
        if ($customerLogin->can('viewProject', $project)) {
            $users = $project->users()->paginate(config('variables.paginate'));
            $data = [
                'project' => $project,
                'users' => $users
            ];
            return view('customer.project.show', $data);
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
}

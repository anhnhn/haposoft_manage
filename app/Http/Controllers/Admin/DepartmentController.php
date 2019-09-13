<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(Config('variables.paginate'));
        $data = [
            'departments' => $departments
        ];
        return view('admin.department.index', $data);
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(DepartmentRequest $request)
    {
        $department = $request->all();
        Department::create($request->all());
        return redirect()->route('departments.index')->with('message', __('messages.create_message'));
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $data = [
            'department' => $department
        ];
        return view('admin.department.update', $data);
    }

    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        foreach ($department->users()->get() as $user)
        {
            $user['department_id'] = null;
            $user->update();
        }
        $department->delete();
        return redirect()->route('departments.index')->with('message', __('messages.delete_message'));
    }

    public function search(Request $request)
    {
        if($request->department_name == null)
        {
            return redirect()->route('departments.index');
        }
        else
        {
            $department_name = $request->department_name;
            $departments = Department::where('name', 'like', '%' . $department_name . '%')->orderByDesc('id')->paginate(config('variables.paginate'));
            $data = [
                'departments' => $departments,
                'departmentName' => $department_name
            ];
            return view('admin.department.index', $data);
        }
    }
}

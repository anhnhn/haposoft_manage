<?php

namespace App\Http\Controllers\User;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(ReportRequest $request)
    {
        $input = $request->except('tasks');
        $tasks = $request->get('tasks');
        $report = Report::create($input);
        $report->tasks()->attach($tasks);
        return redirect()->route('users.showReport', $input['user_id'])->with('message', __('messages.create_message'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        $tasks  = $report->tasks()->get();
        $data = [
            'report' => $report,
            'tasks' => $tasks
        ];
        return view('user.report.show', $data);
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $tasks = $report->tasks()->get();
        $listTaskUser = Auth::user()->tasks;
        $data = [
            'report' => $report,
            'tasks' => $tasks,
            'listTaskUser' => $listTaskUser
        ];
        return view('user.report.update', $data);
    }

    public function update(ReportRequest $request, $id)
    {
        $report = Report::findOrFail($id);
        $input = $request->except('tasks');
        $tasks = $request->get('tasks');
        $report->tasks()->detach();
        $report->update($input);
        $report->tasks()->attach($tasks);
        return redirect()->route('users.showReport', $input['user_id'])->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {

    }
}

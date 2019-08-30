<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('id', 'desc')->paginate(Config('variables.paginate'));
        $data = [
            'reports' => $reports,
        ];
        return view("admin.report.index", $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        $tasks  = $report->tasks()->get();
        $data = [
            'report' => $report,
            'tasks' => $tasks
        ];
        return view('admin.report.show', $data);
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
        $report = Report::findOrFail($id);
        $report->tasks()->detach();
        $report->delete();
        return redirect()->route('reports.index')->with('message', __('messages.delete_message'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $data = [
            'user' => $user
        ];
        return view('user.home', $data);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user
        ];
        return view('user.update', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete('/' . $user->avatar);
            $input['avatar'] = $request->file('avatar')->store('images', ['disk' => 'public']);
        }
        $user->update($input);
        return redirect()->route('user-users.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {

    }

    public function showReport($id)
    {
        $user = User::findOrFail($id);
        $reports = $user->reports;
        $data = [
            'user' => $user,
            'reports' => $reports
        ];
        return view('user.report.show-report', $data);
    }

    public function createReport($id)
    {
        $user = User::findOrFail($id);
        $tasks = $user->tasks;
        $data = [
            'user' => $user,
            'tasks' => $tasks,
        ];
        return view('user.report.create', $data);
    }
}

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
        $userUpdate = User::findOrFail($id);
        $url = $userUpdate->getUrlAttribute($userUpdate->avatar);
        $user = Auth::user();
        if ($user->can('update', $userUpdate)) {
            $data = [
                'user' => $user,
                'url' => $url
            ];
            return view('user.update', $data);
        }
        else {
            return abort('401');
        }
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
        $userLogin = Auth::user();
        $user = User::findOrFail($id);
        $reports = $user->reports;
        if ($userLogin->can('showReport', $reports->first()))
        {
            $data = [
                'user' => $user,
                'reports' => $reports
            ];
            return view('user.report.show-report', $data);
        }
        else {
            return abort('401');
        }
    }

    public function createReport($id)
    {
        $user = User::findOrFail($id);
        $userLogin = Auth::user();
        if($userLogin->can('createReport', $user)) {
            $tasks = $user->tasks;
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            return view('user.report.create', $data);
        }
        else
        {
            return abort('401');
        }
    }
}

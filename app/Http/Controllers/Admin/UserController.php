<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(Config('variables.paginate'));
        $data = ['users' => $users];
        return view('admin.user.index', $data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $input = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $input['avatar'] = $request->file('avatar')->store('images', ['disk' => 'public']);
        }
        $input['password'] = \Hash::make($request->password);
        User::create($input);
        return redirect()->route('users.index')->with('message', __('messages.create_message'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $url = $user->getUrlAttribute($user->avatar);
        $data = [
            'user' => $user,
            'url' => $url
        ];
        return view('admin.user.show', $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = ['user' => $user];
        return view('admin.user.update', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete('/' . $user->avatar);
            $input['avatar'] = $request->file('avatar')->store('images', ['disk' => 'public']);
        }
        $input['password'] = \Hash::make($request->get('password'));
        $user->update($input);
        return redirect()->route('users.index')->with('message', __('messages.update_message'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('message', __('messages.delete_message'));
    }
}

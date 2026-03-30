<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('id')->get();

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user === null) {
            abort(404);
        }

        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($user === null) {
            abort(404);
        }
        $user->update($request->validated());

        return redirect()->route('admin.users.index')->with('status', __('admin.user_updated'));
    }
}

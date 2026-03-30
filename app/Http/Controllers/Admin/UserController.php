<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Support\FakeData;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => FakeData::users()]);
    }

    public function edit($id)
    {
        $u = FakeData::userById($id);
        if ($u === null) {
            abort(404);
        }

        return view('admin.users.edit', ['user' => $u]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if (FakeData::userById($id) === null) {
            abort(404);
        }
        $v = $request->validated();
        $list = [];
        foreach (FakeData::users() as $row) {
            if ($row['id'] == $id) {
                $list[] = [
                    'id' => (int) $id,
                    'first_name' => $v['first_name'],
                    'last_name' => $v['last_name'],
                    'email' => $v['email'],
                ];
            } else {
                $list[] = $row;
            }
        }
        FakeData::saveUsers($list);

        return redirect()->route('admin.users.index')->with('status', __('admin.user_updated'));
    }
}

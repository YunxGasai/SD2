<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(StoreRegisterRequest $request)
    {
        $input = $request->validated();

        $user = new User;
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->save();

        $clientRole = Role::where('name', 'client')->first();
        if ($clientRole === null) {
            abort(500);
        }

        $user->roles()->attach($clientRole->id);

        Auth::login($user);

        return redirect()->route('home')->with('status', __('auth.register_ok'));
    }
}

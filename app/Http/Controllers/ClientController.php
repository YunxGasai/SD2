<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Conference;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $conferences = Conference::query()
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->get();

        return view('client.index', [
            'conferences' => $conferences,
        ]);
    }

    public function show($id)
    {
        $conference = Conference::find($id);
        if ($conference === null || $conference->is_past) {
            abort(404);
        }

        return view('client.show', ['conference' => $conference]);
    }

    public function registerForm($id)
    {
        $conference = Conference::find($id);
        if ($conference === null || $conference->is_past) {
            abort(404);
        }

        return view('client.register', ['conference' => $conference]);
    }

    public function registerStore(StoreRegistrationRequest $request, $id)
    {
        $conference = Conference::find($id);
        if ($conference === null || $conference->is_past) {
            abort(404);
        }

        $v = $request->validated();

        DB::table('users_conferences')->insert([
            'conference_id' => $conference->id,
            'user_id' => null,
            'registrant_name' => $v['name'],
            'registrant_email' => $v['email'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('client.conferences.show', $id)->with('status', __('conference.register_ok'));
    }
}

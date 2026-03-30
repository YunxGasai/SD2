<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Conference;
use Illuminate\Support\Facades\Auth;
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

        $user = Auth::user();

        $already = DB::table('users_conferences')
            ->where('conference_id', $conference->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($already) {
            return redirect()
                ->route('client.conferences.show', $id)
                ->with('error', __('conference.already_registered'));
        }

        DB::table('users_conferences')->insert([
            'conference_id' => $conference->id,
            'user_id' => $user->id,
            'registrant_name' => null,
            'registrant_email' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('client.conferences.show', $id)->with('status', __('conference.register_ok'));
    }
}

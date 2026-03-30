<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $conferences = Conference::query()->orderBy('date')->get();

        return view('employee.index', [
            'conferences' => $conferences,
        ]);
    }

    public function show($id)
    {
        $conference = Conference::find($id);
        if ($conference === null) {
            abort(404);
        }

        $rows = DB::table('users_conferences')
            ->where('conference_id', $conference->id)
            ->get();

        $registrations = [];
        foreach ($rows as $row) {
            if ($row->user_id !== null) {
                $user = User::find($row->user_id);
                if ($user) {
                    $registrations[] = [
                        'name' => trim($user->first_name.' '.$user->last_name),
                        'email' => $user->email,
                    ];
                }
            } else {
                $registrations[] = [
                    'name' => $row->registrant_name ?? '',
                    'email' => $row->registrant_email ?? '',
                ];
            }
        }

        return view('employee.show', [
            'conference' => $conference,
            'registrations' => $registrations,
        ]);
    }
}

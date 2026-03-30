<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::query()->orderBy('date')->get();

        return view('admin.conferences.index', ['conferences' => $conferences]);
    }

    public function create()
    {
        return view('admin.conferences.create');
    }

    public function store(StoreConferenceRequest $request)
    {
        Conference::create($request->validated());

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_created'));
    }

    public function show($id)
    {
        $conference = Conference::find($id);
        if ($conference === null) {
            abort(404);
        }

        return view('admin.conferences.show', ['conference' => $conference]);
    }

    public function edit($id)
    {
        $conference = Conference::find($id);
        if ($conference === null) {
            abort(404);
        }

        return view('admin.conferences.edit', ['conference' => $conference]);
    }

    public function update(UpdateConferenceRequest $request, $id)
    {
        $conference = Conference::find($id);
        if ($conference === null) {
            abort(404);
        }
        $conference->update($request->validated());

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_updated'));
    }

    public function destroy($id)
    {
        $conference = Conference::find($id);
        if ($conference === null) {
            abort(404);
        }
        if ($conference->is_past) {
            return redirect()->route('admin.conferences.index')->with('error', __('admin.cannot_delete_past'));
        }
        $conference->delete();

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_deleted'));
    }
}

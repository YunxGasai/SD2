<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Support\FakeData;

class ConferenceController extends Controller
{
    public function index()
    {
        return view('admin.conferences.index', ['conferences' => FakeData::conferences()]);
    }

    public function create()
    {
        return view('admin.conferences.create');
    }

    public function store(StoreConferenceRequest $request)
    {
        $v = $request->validated();
        $list = FakeData::raw();
        $list[] = [
            'id' => FakeData::nextId(),
            'title' => $v['title'],
            'description' => $v['description'],
            'lecturers' => $v['lecturers'],
            'date' => $v['date'],
            'time' => $v['time'],
            'address' => $v['address'],
        ];
        FakeData::saveRaw($list);

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_created'));
    }

    public function show($id)
    {
        $c = FakeData::conferenceById($id);
        if ($c === null) {
            abort(404);
        }

        return view('admin.conferences.show', ['conference' => $c]);
    }

    public function edit($id)
    {
        $c = FakeData::conferenceById($id);
        if ($c === null) {
            abort(404);
        }

        return view('admin.conferences.edit', ['conference' => $c]);
    }

    public function update(UpdateConferenceRequest $request, $id)
    {
        if (FakeData::conferenceById($id) === null) {
            abort(404);
        }
        $v = $request->validated();
        $list = [];
        foreach (FakeData::raw() as $row) {
            if ($row['id'] == $id) {
                $list[] = [
                    'id' => (int) $id,
                    'title' => $v['title'],
                    'description' => $v['description'],
                    'lecturers' => $v['lecturers'],
                    'date' => $v['date'],
                    'time' => $v['time'],
                    'address' => $v['address'],
                ];
            } else {
                $list[] = $row;
            }
        }
        FakeData::saveRaw($list);

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_updated'));
    }

    public function destroy($id)
    {
        $c = FakeData::conferenceById($id);
        if ($c === null) {
            abort(404);
        }
        if ($c['is_past']) {
            return redirect()->route('admin.conferences.index')->with('error', __('admin.cannot_delete_past'));
        }
        $list = [];
        foreach (FakeData::raw() as $row) {
            if ($row['id'] != $id) {
                $list[] = $row;
            }
        }
        FakeData::saveRaw($list);

        return redirect()->route('admin.conferences.index')->with('status', __('admin.conference_deleted'));
    }
}

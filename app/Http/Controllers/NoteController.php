<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => 'success',
            'data' => [
                'notes' => new NoteResource(Note::all())
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail->storeAs('public/thumbnails', $thumbnail->hashName());
            $note = Note::create([
                ...$request->all(),
                'thumbnail' => $thumbnail->hashName()
            ]);
        } else {
            $note = Note::create($request->all());
        }

        return [
            'status' => 'success',
            'message' => 'data berhasil disimpan',
            'data' => [
                'note' => $note
            ]
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return [
            'status' => 'success',
            'data' => [
                'note' => new NoteResource($note)
            ]
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->all());

        return [
            'status' => 'success',
            'message' => 'data berhasil diubah',
            'data' => [
                'note' => $note
            ]
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return [
            'status' => 'success',
            'message' => 'data berhasil dihapus'
        ];
    }
}

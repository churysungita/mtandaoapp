<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use App\Models\Subtopic;
use Yajra\DataTables\DataTables;

class AdminNotesController extends Controller
{
    public function index()
{
    $notes = Note::all();
    return view('admin.notes.list', compact('notes'));
}

public function create()
{
    
    $subtopics = Subtopic::all(); // Retrieve all subtopics
    return view('admin.notes.create', compact('subtopics'));
}

public function store(Request $request)
{
    // Validate and store the new note
    Note::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        // ... other fields
    ]);

    return redirect()->route('admin.notes.list')->with('success', 'Note created successfully.');
}

public function edit($id)
{
    $note = Note::findOrFail($id);
    $subtopics = Subtopic::all();
    return view('admin.notes.edit', compact('note', 'subtopics'));
}

public function update(Request $request, $id)
{
    $note = Note::findOrFail($id);
    // Validate and update the note
    $note->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'subtopic_id' => $request->input('subtopic_id'),
        // ... other fields
    ]);

    return redirect()->route('admin.notes.list')->with('success', 'Note updated successfully.');
}

public function destroy($id)
{
    $note = Note::findOrFail($id);
    $note->delete();

    return redirect()->route('admin.notes.list')->with('success', 'Note deleted successfully.');
}

}

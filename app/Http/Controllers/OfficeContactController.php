<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeContact;

class OfficeContactController extends Controller
{
    public function index()
    {
        $officeContacts = OfficeContact::all();
        return view('admin.office_contacts.index', compact('officeContacts'));
    }

    
    public function welcome()
    {
        $officeContacts = OfficeContact::all();        
        return view('welcome', compact('officeContacts'));
    }



    public function create()
    {
        return view('admin.office_contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        OfficeContact::create($data);

        return redirect()->route('admin.office_contacts.index')->with('success', 'Office contact created successfully.');
    }

    public function show(OfficeContact $officeContact)
    {
        return view('admin.office_contacts.show', compact('officeContact'));
    }

    public function edit(OfficeContact $officeContact)
    {
        return view('admin.office_contacts.edit', compact('officeContact'));
    }

    public function update(Request $request, OfficeContact $officeContact)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $officeContact->update($data);

        return redirect()->route('admin.office_contacts.index')->with('success', 'Office contact updated successfully.');
    }

    public function destroy(OfficeContact $officeContact)
    {
        $officeContact->delete();

        return redirect()->route('admin.office_contacts.index')->with('delete', 'Office contact deleted successfully.');
    }
}

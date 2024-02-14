<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller

 {
    
     // Display the list of users
     public function index()
     {
        //  $users = User::all();
         $users = User::orderBy('id', 'desc')
         ->get();
         return view('users.index', compact('users'));
     }


 
     // Show the form to create a new user
     public function create()
     {
         return view('users.create');
     }
 
     // Store the newly created user
     public function store(Request $request)
     {
         // Validation rules
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'phone' => 'required|string|max:255',
             'address' => 'required|string|max:255',
             'usertype' => 'required|in:1,2,3',
             'password' => $this->passwordRules(),
         ]);
 
         // Create user
         $user = User::create([
             'name' => $validatedData['name'],
             'email' => $validatedData['email'],
             'phone' => $validatedData['phone'],
             'address' => $validatedData['address'],
             'usertype' => $validatedData['usertype'],
             'password' => Hash::make($validatedData['password']),
         ]);
 
         return redirect()->route('users')->with('success', 'User created successfully!');
     }
 
     // Show the form to edit an existing user
    //  public function edit(User $user)
    //  {
    //      return view('admin.user.edit', compact('user'));
    //  }
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }
 
     // Update an existing user
    //  public function update(Request $request, User $user)
    //  {
    //      // Validation rules
    //      $validatedData = $request->validate([
    //          'name' => 'required|string|max:255',
    //          'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    //          'phone' => 'required|string|max:255',
    //          'address' => 'required|string|max:255',
    //          'usertype' => 'required|in:1,2,3',
    //      ]);
 
    //      // Update user details
    //      $user->update([
    //          'name' => $validatedData['name'],
    //          'email' => $validatedData['email'],
    //          'phone' => $validatedData['phone'],
    //          'address' => $validatedData['address'],
    //          'usertype' => $validatedData['usertype'],
    //      ]);
 
    //      return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    //  }

     public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);

        $validated = $request->validate([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'usertype' => $validatedData['usertype'],
        ]);

        $input['password'] = Hash::make($input['password']);

        User::where('id', $id)
            ->update($input);

        return redirect()->route('users.index');
    }

 
     // Show the form to delete an existing user
     public function delete(User $user)
     {
         return view('user.delete', compact('user'));
     }
 
     // Delete an existing user
    //  public function destroy(User $user)
    //  {
    //      $user->delete();
    //      return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
    //  }

     public function destroy($id)
     {
         User::find($id)
             ->delete();
 
         return redirect()->route('users.index');
     }
}

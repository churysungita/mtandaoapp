<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Hashids\Hashids;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_users');
    }

  


    public function adminAddUsers(Request $request)
    {
        $user = new User(); // Fixed variable name from 'users' to 'user'
        $user->name = $request->input('name'); // Use input() method to get form data
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->usertype = $request->input('usertype');
        $user->password = Hash::make($request->input('password')); // Hash the password

        $user->save();
        return redirect()->back()->with('success', 'User added successfully!');
    }


    public function userList()
    {
        $users = User::all();
        return view('admin.users_list', compact('users'));
    }

  

    public function updateUser(Request $request, $id)
    {    $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required', 'email',
            Rule::unique('users')->ignore($id),
        ],
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:255',
        'usertype' => ['required', Rule::in(['1', '2', '3'])],
        'password' => 'nullable|string|min:6',
    ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->usertype = $request->input('usertype');
        // $user->password = Hash::make($request->input('password'));

        // $user->save();
        // return redirect()->route('admin.userList')->with('message', 'User updated successfully!');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Return a JSON response indicating success
        return redirect()->route('admin.userList')->with('messageupdated', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.userList')->with('messagedeleted', 'User deleted successfully!');
    }



    public function getUsersData($id)
{
    $user = User::find($id);
    return response()->json($user);
}


}

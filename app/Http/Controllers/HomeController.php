<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function redirects()
    {
        if (Auth::id()) {
            switch (Auth::user()->usertype) {
                case '3':
                    return view('student.home');
                case '2':
                    return view('teacher.home');
                default:
                    return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }

    public function index()
    {
        return view ('student.home',['users'=> $users]);
    }
}


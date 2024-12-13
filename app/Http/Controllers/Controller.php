<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\Hp;
use App\Support\Facades\DB;
use App\View\View;

abstract class Controller
{
    public function index()
    {
        // Get all users
        $users = Hp::all();

        // Return data to a view
        return view('users.index', compact('users'));
    }
}

// class UserController extends Controller
// {
//     /**
//      * Show a list of all of the application's users.
//      */
//     public function index(): View
//     {
//         $users = DB::select('select * from users where active = ?', [1]);
 
//         return view('user.index', ['users' => $users]);
//     }
// }
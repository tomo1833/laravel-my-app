<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Inertia\Inertia;

class UserController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        return Inertia::render('User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }
}

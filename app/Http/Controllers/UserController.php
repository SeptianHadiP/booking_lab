<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.users.index', [
            // 'name' => $this->name,
            // 'allPermissions' => $this->allPermissions,
        ]);
    }

    public function create()
    {
        // $this->validate( [
        //     'name' => 'required|',
        //     'email' => 'required|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        return view('dashboard.pages.users.create-user', [
            // 'name' => $this->name,
            // 'allPermissions' => $this->allPermissions,
        ]);
    }

}

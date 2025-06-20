<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesController extends Controller
{
    public $name;
    public $allPermissions = [];
    public $permissions = [];

    public function mount() {
        $this->allPermissions = Permission::get();
    }

    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('dashboard.pages.roles.index', compact("roles"));
    }

    public function create()
    {
        // $this->validate( [
        //     'name' => 'required|',
        //     'email' => 'required|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        return view('dashboard.pages.roles.create-role', [
            // 'name' => $this->name,
            // 'allPermissions' => $this->allPermissions,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Permission;

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
        return view('dashboard.pages.roles.index', [
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
        return view('dashboard.pages.roles.create-role', [
            // 'name' => $this->name,
            // 'allPermissions' => $this->allPermissions,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('dashboard.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.pages.roles.create-role', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
    }

    public function show($id)
    {
        $role = role::findOrFail($id);
        return view('dashboard.pages.roles.show-role', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all(); // ambil semua permission
        $hasPermissions = $role->permissions->pluck('name'); // permission yang sudah dimiliki role

        return view('dashboard.pages.roles.update-role', compact('role', 'permissions', 'hasPermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'array' // tambahkan ini agar permissions divalidasi
        ]);

        $role->name = $request->name;
        $role->save();

        // Tambahkan baris ini untuk menyimpan permissions
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            // Jika tidak ada permission yang dipilih, kosongkan semuanya
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus!');
    }


}

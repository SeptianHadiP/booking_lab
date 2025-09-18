<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $allRoles;
    public $roles = [];
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.pages.users.index', [
            'users' => $users,
            'allRoles' => $this->allRoles,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.pages.users.show-user', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();
        $hasRoles = $user->roles->pluck('name', 'asc');
        return view('dashboard.pages.users.edit-user', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'array',
        ]);

        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // Sync roles
            if (!empty($request->roles)) {
                $user->syncRoles($request->roles);
            } else {
                $user->syncRoles([]);
            }

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully.');
        } else {
            return redirect()->route('users.edit', ['id' => $id])
                ->withInput()
                ->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{


        /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view user'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create user'), only:['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit user'), only:['update', 'edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete user'), only:['destroy'])
        ];
    }
    public function index() {

        $users = User::with('roles')->whereHas("roles", function($q) {
                    $q->whereNotIn("name", ['Super Admin', 'Client']);
                })->get();

        $users = User::withoutRole(['Super Admin', 'Client'])->get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
    }

    public function create() {

        $roles = Role::all();
        return view('role-permission.user.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', "User Created Successfully With Roles!");

    }

    public function edit(User $user) {

        $roles = Role::all();
        $userRoles = $user->roles->pluck('name','name')->all();

        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user) {

        $request->validate([
            'name' => 'required|string|max:255',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)) {

          $data[] = [
            'password' => Hash::make($request->password),
        ];

        }
        $user->update($data);

        $user->syncRoles($request->roles);


        return redirect('/users')->with('status', "User Updated Successfully!");

    }

    public function destroy($userId) {

        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->back()->with('status', "User Deleted Successfully!");

    }
}

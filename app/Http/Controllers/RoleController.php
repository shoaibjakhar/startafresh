<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view role'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create role'), only:['create', 'store', 'addPermissionToRole', 'givePermissionToRole']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit role'), only:['update', 'edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete role'), only:['destroy'])
        ];
    }
    public function index() {
        $roles = Role::all();
        return view('role-permission.role.index', [
            'roles' => $roles
        ]);
    }

    public function create() {
        return view('role-permission.role.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name'  => $request->name
        ]);

        return redirect('roles')->with('status', "Role Created Successfully!");
    }

    public function edit(Role $role) {
        
        return view('role-permission.role.edit', [
            'role' => $role
        ]);


    }

    public function update(Request $request, Role $role) {

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', "Role Updated Successfully!");
        

    }

    public function destroy($roleId) {

        $permission = Role::find($roleId);
        $permission->delete();

        return redirect('roles')->with('status', "Role Deleted Successfully!");
    }

    public function addPermissionToRole($roleId) {

        $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId) {

        $role = Role::findOrFail($roleId);

        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('status', "Permissions Added To Role");

    }
}

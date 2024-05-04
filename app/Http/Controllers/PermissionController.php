<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller
{

        /**
     * Get the middleware that should be assigned to the controller.
     */
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view permission'), only:['index']),
    //         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create permission'), only:['create', 'store']),
    //         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('edit permission'), only:['update', 'edit']),
    //         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete permission'), only:['destroy'])
    //     ];
    // }
    public function index() {
        $permissions = Permission::all();
        return view('role-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create() {
        return view('role-permission.permission.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name'  => $request->name
        ]);

        return redirect('permissions')->with('status', "Permission Created Successfully!");
    }

    public function edit(Permission $permission) {
        
        return view('role-permission.permission.edit', [
            'permission' => $permission
        ]);


    }

    public function update(Request $request, Permission $permission) {

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', "Permission Updated Successfully!");
        

    }

    public function destroy($permissionId) {

        $permission = Permission::find($permissionId);
        $permission->delete();

        return redirect('permissions')->with('status', "Permission Deleted Successfully!");
    }
}

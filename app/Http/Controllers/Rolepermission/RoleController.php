<?php

namespace App\Http\Controllers\Rolepermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        $permissions = Permission::all();
        return view('admin.role.index', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }


    public function permission_submit(Request $request)
    {
        Permission::create(['name' => $request->permission_name]);
        return back();
    }
    public function role_submit(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);
        $role -> givePermissionTo($request->permissions);
        return back();
    }

    public function assign_role(Request $request)
    {
        $users = User::find($request->user_id);
        $users->assignRole($request->role_id);
        return back();
    }

    public function edit_permission($id)
    {
        $permissions = Permission::all();
        $user = User::find($id);
        return view('admin.role.edit', [
            'permissions' => $permissions,
            'user' => $user,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManagerController extends Controller
{
    public function index()
    {

    }

    public function setPermission(Request $request)
    {
        $request->validate([
            'role' => ['required', 'numeric'],
            'permission_id' => ['required', 'numeric'],
            'action' => ['required', 'string', 'min:3', 'max:6'],
        ]);

        $message = "dd";
        $error_code = 200;

        $role = Role::find($request->role);
        $permission = Permission::find($request->permission_id);

        if(!$role)
        {
            $message = "Role not found";
            $error_code = 404;
        }
        if(!$permission)
        {
            $message = "Permission not found";
            $error_code = 404;
        }

        // $self_action = $permission->hasRole($role->name) ? "remove" : "add";
        if($request->action == "add")
        {
            $role->givePermissionTo($permission->name);
            $message = "Permission accordée";
            $error_code = 201;
        }elseif($request->action == "remove"){
            $role->revokePermissionTo($permission->name);
            $message = "Permission revoquée";
            $error_code = 201;
        }else{
            $message = "action denied";
            $error_code = 301;
        }
        
        return response()->json([
            'message' => $message,
        ],$error_code);
    }
}

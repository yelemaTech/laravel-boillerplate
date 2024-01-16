<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManagerController extends Controller
{
    public function managerView()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('manager.index', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validateWithBag('storeRole', [
            'role' => ['required', 'string', 'min:4', 'max:10'],
        ]);

        $role = Role::create(['name' => $request->role]);

        return redirect()->back()->with('success', 'role créé avec succès.');
    }

    public function storePermission(Request $request)
    {
        $request->validateWithBag('storePermission', [
            'permission' => ['required', 'string', 'min:4', 'max:50'],
        ]);

        Permission::create(['name' => $request->permission]);

        return redirect()->back()->with('success', 'permission créée avec succès.');
    }

    public function showRole(Role $role)
    {
        $permissions = Permission::all();
        return view('manager.showRole', compact('role', 'permissions'));
    }

    public function attachPermission(Request $request, Role $role)
    {
        $request->validateWithBag('storePermission', [
            'permission' => ['required', 'string', 'min:4', 'max:20'],
        ]);

        Permission::create(['name' => $request->permission]);

        return redirect()->back()->with('success', 'permission créée avec succès.');
    }
}

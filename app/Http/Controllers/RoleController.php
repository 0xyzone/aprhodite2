<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            Rule::unique('roles', 'name')]);
        Role::create($validated);

        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')->ignore($role->id)]
        ]);

        $role->update($validated);

        return redirect(route('role.index'))->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    public function givePermission(Request $request, Role $role)
    {
        foreach ($request->permission as $perm) {
        if ($role->hasPermissionTo($perm)) {
            return back()->with('error', 'Permission already exisits');
        }
            $role->givePermissionTo($perm);
        }
        
        return back()->with('success', 'Permission assigned successfully.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('success', 'Permission revoked.');
        }
        return back()->with('error', 'Permission does not exisit.');
    }
}

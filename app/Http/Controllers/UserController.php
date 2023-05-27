<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $formFields = $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->roles) {
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
        }

        return redirect(route('users.index'))->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $oldemail = $user->email;
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['email', 'required', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        if($oldemail != $request->email) {
            $request['email_verified_at'] = null;
        }
        $user->update($request->all());
        $user->sendEmailVerificationNotification();

        return back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function giveRole(Request $request, User $user)
    {
        foreach ($request->roles as $role) {
            if ($user->hasRole($role)) {
                return back()->with('error', 'User role already exisits');
            }
            $user->assignRole($role);
        }

        return back()->with('success', 'Role assigned successfully.');
    }

    public function revokeRole(User $user, $role)
    {
        $count = $user->getRoleNames()->count();
        if ($count == 1) {
            return back()->with('error', 'Atleast 1 role is required.');
        }
        $user->removeRole($role);
        return back()->with('success', 'Role removed.');
    }
}

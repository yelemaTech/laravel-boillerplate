<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;

use Spatie\Permission\Models\Role;

class InitController extends Controller
{
    public function init(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if(User::all()->count() > 0)
        {
            return redirect()->route('login');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    public function initView()
    {
        return view('init.index');
    }
}

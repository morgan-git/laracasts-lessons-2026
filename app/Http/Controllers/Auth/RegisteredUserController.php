<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public const REDIRECT_PATH = '/ideas';

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255', Password::default()],
        ]);

        // create user in db
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // log them in
        Auth::login($user);

        // redirect to home
        return redirect(self::REDIRECT_PATH)->with('success', 'Account created successfully!');
    }
}

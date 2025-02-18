<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function adminLogin(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {

            $user = Auth::user();

            if ($user->role != 'admin') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'invalid' => 'This user does not belong here.'
                ]);
            }

            return redirect()->route('dashboard.index');
        }

        throw ValidationException::withMessages([
            'invalid' => 'Invalid login credentials.'
        ]);
    }

    public function cashierLogin(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {

            $user = Auth::user();

            if ($user->role != 'cashier') {
                Auth::logout();
                throw ValidationException::withMessages([
                    'invalid' => 'This user does not belong here.'
                ]);
            }

            return redirect()->route('cashier.index');
        }

        throw ValidationException::withMessages([
            'invalid' => 'Invalid login credentials.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        //validate email and password
        $credentials = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        //attempt to login if not throw Validation exception
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Sorry, those credentials do not feet'
                ]
            );
        }
        //regenerate token
        $request->session()->regenerate();

        //redirect to main page
        return redirect('/');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}

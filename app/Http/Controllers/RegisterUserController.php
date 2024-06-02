<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate user data
        $userAttr = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        //validate employer data
        $employerAttr = $request->validate([
            'employer' => 'required',
            'logo' => ['required', File::types(['jpg', 'png', 'webp'])]
        ]);

        //create User
        $user = User::create($userAttr);

        //upload logo
        $logoPath = $request->logo->store('logos');

        //attach employer
        $user->employer()->create([
            'name' => $employerAttr['employer'],
            'logo' => $logoPath,
        ]);

        //login user
        Auth::login($user);

        //redirect to main page
        return redirect('/');
    }
}

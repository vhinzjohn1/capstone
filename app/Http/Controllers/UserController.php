<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function register(Request $request)
    {
        // Add validation rules for your form fields here
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'grade_level' => 'required|string', // Corrected rule for grade level
            'birth_date' => 'required|date', // Corrected rule for birthdate
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);


        // Hash the password before saving to the database
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        // Log in the user
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'User registered successfully and logged in.');
    }

    public function login(Request $request)
    {
        // Validate the login request with custom error messages
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'The username field is required.',
            'password.required' => 'The password field is required.',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed
            return redirect('/dashboard');
        }

        // Authentication failed
        return redirect('/login')->with('error', 'Invalid login credentials.');

    }


    public function showRegistrationForm()
    {
        return view('signup');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Redirect to the login page or any other desired page
        return redirect('/login');
    }

}


<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'user_first_name' => 'required|string|max:255',
            'user_last_name' => 'required|string|max:255',
            'user_mobile' => 'required|string|min:10|max:10|unique:users,user_mobile',
            'user_email' => 'required|string|email|max:255|unique:users,user_email',
            'password' => 'required|string|confirmed|min:8|max:255',
            'user_city' => 'required|string|max:255',
            'user_state' => 'required|string|max:255',
            'user_country' => 'required|string|max:255',
        ]);
        
        $user = User::create([
            'user_first_name' => $validatedData['user_first_name'],
            'user_last_name' => $validatedData['user_last_name'],
            'user_mobile' => $validatedData['user_mobile'],
            'user_email' => $validatedData['user_email'],
            'password' => Hash::make(($validatedData['password'])), 
            'user_city' => $validatedData['user_city'],
            'user_state' => $validatedData['user_state'],
            'user_country' => $validatedData['user_country'],
        ]);
    
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

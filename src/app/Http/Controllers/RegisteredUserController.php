<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class RegisteredUserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('user_registration');
    }

    public function create(UserRequest $request)
    {
        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('login');

    }
}

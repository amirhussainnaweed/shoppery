<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index(){
        $user = auth()->user();
        
        return Inertia::render('Account/Settings', [
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
        ]);

        $user = auth()->user();

        $user->name = $data['firstName'];
        $user->lastname = $data['lastName'];
        $user->email = $data['email'];
        $user->phonenumber = $data['phone'];
        $user->profile_image = $data['image'];

        $user->save();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index(){
        $user = auth()->user();
        $addresses = $user->addresses()->first();
        
        return Inertia::render('Account/Settings', [
            'user' => $user,
            'addresses' => $addresses
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

    public function updateBilling(Request $request){
        $data = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipCode' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $addresses = $user->addresses()->first();

        $user->name = $data['firstName'];
        $user->lastname = $data['lastName'];
        $user->email = $data['email'];
        $user->phonenumber = $data['phone'];
        $addresses->address_text = $data['street'];
        $addresses->country = $data['country'];
        $addresses->city = $data['state'];
        $addresses->postal_code = $data['zipCode'];

        $user->save();
        $addresses->save();

        return back();
    }
}

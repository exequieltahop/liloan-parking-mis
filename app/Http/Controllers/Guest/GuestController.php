<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    // log in
    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'remember_me' => ['nullable'],
        ], [
            'required' => 'This field is required',
            'min' => 'Password must alteast be 8 charactes longs.',
        ]);

        // attemp login
        $status = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->filled('remember_me'));

        // check status if login
        if (! $status) {
            session()->flash('error', 'Invalid Credentials');

            return redirect()->back();
        }

        session()->flash('success', 'Successfully Log In!');

        return redirect()->route('dashboard');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

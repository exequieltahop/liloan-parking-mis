<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    // log in
    public function processLogin(Request $request)
    {
        try {
            // validator
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            /**
             * if validator fails then log error and return back
             * with errors
             */
            if ($validator->fails()) {
                session()->flash('error', 'Invalid Credentials');
                Log::error(json_encode($validator->errors(), JSON_PRETTY_PRINT));
                return redirect()->back();
            }

            // attemp login
            $status = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            // check status if login
            if (!$status) {
                session()->flash('error', 'Invalid Credentials');
                return redirect()->back();
            }

            // return 200
            session()->flash('success', "Successfully Log In!");
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            /**
             * log error
             * return redirect back with error
             */
            Log::error($th->getMessage());
            session()->flash('error', 'Failed to log in, Pls Try again, If the problem persist pls contact developer!, Thank you!');
            return redirect()->back();
        }
    }

    // logout
    public function logout(Request $request) {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            abort(500);
        }
    }
}

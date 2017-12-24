<?php

namespace Claws\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller {

    public function __construct() {
        $this->middleware('claws_admin');
    }

    public function getLoginForm() {
        return view('claws::admin.login');
    }
    public function login(Request $request) {
        // Validate the form data
        $this->validate($request, [
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in

        if (Auth::guard('claws_admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended('/admin/dashboard');
        }
            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }
}
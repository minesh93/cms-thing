<?php


namespace Claws\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller {

    public function getLoginForm() {
        return view('claws::admin.login');
    }
    public function login(Request $request) {

        $this->validate($request, [
            'password' => 'required|min:6'
        ]);


        if (Auth::guard('claws_admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/'.config('claws.admin_url').'/dashboard');
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
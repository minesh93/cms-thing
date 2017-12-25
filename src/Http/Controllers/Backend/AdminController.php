<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Auth;

class AdminController extends Controller {

    public function getAdmins() {
        $admins = Admin::all();
        return view('claws::admin.user-list',['admins'=>$admins]);
    }

}
<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Auth;
use PermissionRegister;
use PostRegister;

class AdminController extends Controller {

    public function loadAdmin() {
        PostRegister::getRegister();
        $data = [
            'claws' => [
                'register' => PostRegister::getRegister(),
                'base' => config('claws.admin_url')
            ]
        ];

        return view('claws::admin.dashboard', $data);
    }

    public function getAdmins() {
        $admins = Admin::all();
        return view('claws::admin.user-list',['admins'=>$admins]);
    }


    public function createAdmin(Request $request,$id){

        $data = [
            'user' => new Admin(),
            'roles' => Role::all()
        ];

        if($id !== 'add') {
            $data['user'] = Admin::find($id);
            $data['user']->load('role');
        }

        return view('claws::admin.user-create',$data);
    }

    public function updateAdmin(Request $request,$id ){


        $admin = new Admin();

        if($id != 'add'){
            $admin = Admin::find($id);
            $admin->load('role');
        }

        $admin->username = $request->input('username');
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');

        //- No longer stripping back role array from request as its no longer needed.
        $admin->role_id = $request->input('role_id');

        $admin->email = $request->input('email');

        if($request->has('password') && $request->has('confirm_password')){
            if(strcmp($request->input('password'), $request->input('confirm_password')) !== 0){
                $admin->password = bcrypt($request->input('password'));
            } else {
                //- Erorr about mismatch passwords
                //- Seriously I need to finish this at some point.
            }
        }


        $admin->save();


        return $admin;
    }


    public function getRoles() {

        $roles = Role::all();
        return view('claws::admin.role-list',['roles'=>$roles]);
    }

    public function createRole(Request $request,$id){

        $data = [
            'role' => new Role(),
            'permissions' => collect(PermissionRegister::getRegister())
        ];

        if($id !== 'add') {
            $data['role'] = Role::find($id);
        }

        return view('claws::admin.role-create',$data);
    }

    public function updateRole(Request $request,$id ){

        $role = new Role();

        if($id != 'add'){
            $role = Role::find($id);
        }

        $role->name = $request->input('name');
        $role->key = str_slug($request->input('name'));

        $role->resetPermissions();

        if(is_array($request->input('permissions'))){
        	foreach ($request->input('permissions') as $permission) {
        		$role->addPermission($permission);
        	}
        }

        $role->save();

        return $role;
    }

}
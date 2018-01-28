<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Auth;
use PermissionRegister;

class AdminController extends Controller {

    public function getAdmins() {
        $admins = Admin::all();
        return view('claws::admin.user-list',['admins'=>$admins]);
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
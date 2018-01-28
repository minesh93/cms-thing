<?php

namespace Claws\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [];
    protected $hidden = [];
    protected static $rules = [];
    protected static $dirtyRules = [];
    protected static $messages = [];

    protected $table = 'claws_admin_role';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];



    public function __construct($name = '',$attributes = array()) {
        parent::__construct($attributes);
        $this->permissions = [];
        $this->name = $name;
    }

    //- Someone should really clean this up.
    public function addPermission($permission) {
        $permissions = $this->permissions;
        if(!in_array($permission,  $permissions, true)){
            $permissions[] = $permission;
            $this->permissions = $permissions;
        }
    }

    public function resetPermissions(){
        $this->permissions = [];
    }

    //- Eh.... 
    public function removePermission($permission) {
        array_forget($this->attributes['permissions'], $permission);
    }

}

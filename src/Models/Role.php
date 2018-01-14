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


    public function __construct($name = '',$attributes = array()) {
        parent::__construct($attributes);
        $this->name = $name;
    }

    public function setPermissionsAttribute($value) {
        $this->attributes['permissions'] = serialize($value);
    }

    public function getPermissionsAttribute() {
        return unserialize($this->attributes['permissions']);
    }

    public function addPermission($permission) {
        if(!in_array($permission, $this->attributes['permissions'], true)){
            array_push($this->attributes['permissions'], $permission);
        }
    }

    public function removePermission($permission) {
        array_forget($this->attributes['permissions'], $permission);
    }

}

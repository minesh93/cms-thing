<?php

namespace Claws\Support;

class PermissionRegister {

    static private $registered = [];

    public static function registerSection($name, $key = '', $description = '') {

        if(empty($name)){
            return false;
        }

        $defaultSection = [
            'name' => $name,
            'key' => str_slug($name),
            'description' => '',
            'permissions' => []
        ];

        $sectionToMerge = [
            'name' => $name,
            'key' => $key,
            'description' => $description,
        ];

        $sectionToRegister = $sectionToMerge + $defaultSection;

        self::$registered[$sectionToRegister['key']] = (object) $sectionToRegister;
    }

    public static function register($permission, $section) {

        if(!self::sectionRegistered($section)) {
            return false;
        }

        $permissionToRegister = [];

        if(is_array($permission)){
            if(!array_key_exists('name',$permission)){
                return false;
            }
            
            $defaultPermission = [
                'name' => $permission['name'],
                'key' => str_slug($permission['name']),
            ];

            $permissionToRegister = $permission + $defaultPermission;
        } else {
            $defaultPermission = [
                'name' => $permission,
                'key' => str_slug($permission),
            ];

            $permissionToRegister = $defaultPermission;
        }

        if(!in_array($permissionToRegister['key'], self::$registered[$section]->permissions)){
            self::$registered[$section]->permissions []= (object) $permissionToRegister;
        }

    }

    public static function sectionRegistered($permission){
        return array_key_exists($permission,self::$registered);
    }

    public static function getRegister(){
        return self::$registered;
    }
}
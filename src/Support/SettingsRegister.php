<?php

namespace Claws\Support;

class SettingsRegister {

    private static $settings = [];

    public static function addSection($key, $name, $template) {
        self::$settings[$key] = [
            'name' => $name,
            'template' => $template,
            'key' => $key
        ];
    }

    public static function getSettings(){
        return self::$settings;
    }

    public static function getSection($key){
        return self::$settings[$key];
    }
}
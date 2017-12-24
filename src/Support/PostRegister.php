<?php

namespace Claws\Support;

class PostRegister{

    static private $registered = [];
    static private $currentMeta = '';
    static private $currentPost = '';

    public static function derp(){
    	return 'derp';
    }

    public static function register($post){
        if(!array_key_exists('name',$post)){
            return false;
        }

        if(self::isRegistered($post['name'])){
            return false;
        }

        $postPlural = str_plural($post['name']);
        $postTitle = title_case($post['name']);
        $postTitlePlural = title_case($postPlural);

        $defaultPost = [
            'name' => $post['name'],
            'template' => "template-{$post['name']}",
            'createText' => "Create {$postTitle}",
            'listTitle' => "All {$postTitlePlural}",
            'urlBase' => "/{$post['name']}/",
            'listName' => $postTitlePlural,
            'meta' => []
        ];

        $postToRegister = $post + $defaultPost;

        self::$registered[$post['name']] = (object)$postToRegister;
    }

    public static function isRegistered($post){
        return array_key_exists($post,self::$registered);
    }

    public static function addPostMeta($post,$key,$template){
        self::$registered[$post]->meta[$key] = [];
        self::$registered[$post]->meta[$key]['template'] = $template;
        self::$registered[$post]->meta[$key]['data'] = new \StdClass();

        self::$currentMeta = $key;
        self::$currentPost = $post;

        // ob_start();
        //     include Theme::getThemePath() . "/" . self::$registered[$post]->meta[$key]['template'];
        // ob_get_clean();
    }

    public static function getMetaObject($post){
        $meta = [];
        foreach (self::$registered[$post]->meta as $key => $value) {
            $meta[$key] = $value['data'];
        }
        return (object) $meta;
    }

    public static function getMetaTemplates($post){
        foreach (self::$registered[$post]->meta as $key => $value) {
            self::$currentMeta = $key;
            self::$currentPost = $post;
            // include Theme::getThemePath() . "/" . self::$registered[$post]->meta[$key]['template'];
        }
    }

    public static function addMetaField($key){
        self::$registered[self::$currentPost]->meta[self::$currentMeta]['data']->{$key} = '';
    }

    public static function getRegisteredPost($post){
        return self::$registered[$post];
    }

    public static function getRegister(){
        return self::$registered;
    }
}
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
        $safeName = str_slug($post['name']);

        $defaultPost = [
            'name' => $post['name'],
            'template' => "template-{$safeName}",
            'createText' => "Create {$postTitle}",
            'deleteText' => "Delete {$postTitle}",
            'listTitle' => "All {$postTitlePlural}",
            'icon' => "fa-file-alt",
            'urlBase' => $safeName,
            'listName' => $postTitlePlural,
            'meta' => [],
            'createRoleName' => "create-{$safeName}",
            'deleteRoleName' => "delete-{$safeName}",
            'useCustomTemplates' => false,
            'renderTemplates' => []
        ];

        $postToRegister = $post + $defaultPost;

        $postToRegister['urlBase'] = str_slug($postToRegister['urlBase']);

        self::$registered[$post['name']] = (object)$postToRegister;
        self::addPostRenderTemplate($post['name'],'Use Default Template',-1);
        
        PermissionRegister::register([
            'name' => self::$registered[$post['name']]->createText,
            'key' => self::$registered[$post['name']]->createRoleName,
        ] , 'content');

        PermissionRegister::register([
            'name' => self::$registered[$post['name']]->deleteText,
            'key' => self::$registered[$post['name']]->deleteRoleName,
        ] , 'content');
    }

    public static function isRegistered($post){
        return array_key_exists($post,self::$registered);
    }

    public static function addPostContentTemplate($post, $key, $template, $templateRestriction = false){
        self::$registered[$post]->meta[$key] = [];
        self::$registered[$post]->meta[$key]['template'] = $template;
        self::$registered[$post]->meta[$key]['template-restriction'] = $templateRestriction;
        self::$registered[$post]->meta[$key]['data'] = new \StdClass();
    }

    public static function addPostRenderTemplate($post, $templateName, $templateFile) {
        self::$registered[$post]->renderTemplates[] = ['name' => $templateName, 'file' => $templateFile];
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
        }
    }

    public static function getRegisteredPost($post){
        return self::$registered[$post];
    }

    public static function getRegister(){
        return self::$registered;
    }
}
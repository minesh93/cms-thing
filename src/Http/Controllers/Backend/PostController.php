<?php

namespace Claws\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Post;
use Claws\Models\Content;
use PostRegister;

class PostController extends Controller
{
    public function update(Request $request, $type = 'page', $id) {

        $post = new Post('',$type);

        if($id != 'add') {
            $post = Post::find($id);
        }

        $post->name = $request->input('name');
        
        if(PostRegister::getRegisteredPost($type)->useCustomTemplates){
            $post->template = $request->input('template');
        }

        if($request->input('slug') != '') {
            $post->slug = $this->createSlug(basename($request->input('slug')), $type);
        } else {
            $post->slug = $this->slugGen($post->name,$type);
        }


        $post->save();

        foreach ($request->input('content') as $key => $value) {

            $content = new Content();
            $content->content_key = $key;

            if($post->content()->where('content_key',$key)->count()) {
                $content = $post->content()->where('content_key',$key)->get()->first();
            }
            
            $content->content = $value;
            $content->save();
            
            $post->content()->save($content);
        }

        $post->load('content');
        $post->mapContent();
        return $post;
    }

    public function create(Request $request, $type = 'page' ,$id) {

        if(!PostRegister::isRegistered($type)){
            return 'post not registered';
        }

        $data = [
            'post' => new Post('',$type),
            'type' => PostRegister::getRegisteredPost($type),
            'meta' => PostRegister::getMetaObject($type)
        ];

        $data['post']->mappedContent = $data['meta'];

        if($id !== 'add') {
            $data['post'] = Post::find($id);
            $data['post']->mapContent();
        }


        return view('claws::admin.post-create',$data);
    }

    public function slugGen($name, $type) {
        return $this->createSlug($name,$type);
    }

    public function createSlug($text,$type){
        $register = PostRegister::getRegisteredPost($type);

        $urlBase = ltrim($register->urlBase, '/');
        $urlBase = rtrim($register->urlBase, '/');

        $slug = $register->urlBase . '/' . str_slug($text);
        $slug = ltrim($slug,'/');
        $slug = rtrim($slug,'/');
        return $slug;
    }

    public function getPosts(Request $request,$type = 'page'){

        if(!PostRegister::isRegistered($type)){
            return 'post not registered';
        }

        $postType = PostRegister::getRegisteredPost($type);

        if($type != null) {
            $posts = Post::where('type',$type)->get();
            return view('claws::admin.post-list', ['posts' => $posts,'type' =>  $postType]);
        }
    }
}

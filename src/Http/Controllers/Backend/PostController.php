<?php

namespace Claws\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Post;
use PostRegister;

class PostController extends Controller
{
    public function update(Request $request,$type = 'page',$id){

        $post = new Post('','',$type);

        if($id != 'add'){
            $post = Post::find($id);
        }

        $post->name = $request->input('name');
        $post->content = $request->input('content');

        if(PostRegister::getRegisteredPost($type)->useCustomTemplates){
            $post->template = $request->input('template');
        }
        // if(empty($post->slug)){
            $post->slug = $this->slugGen($request->input('name'),$type);
        // }

        $post->save();

        return $post;
    }

    public function create(Request $request,$type = 'page',$id){

        if(!PostRegister::isRegistered($type)){
            return 'post not registered';
        }

        $data = [
            'post' => new Post('','',$type),
            'type' => PostRegister::getRegisteredPost($type),
            'meta' => PostRegister::getMetaObject($type)
        ];

        $data['post']->content = $data['meta'];

        if($id !== 'add') {
            $data['post'] = Post::find($id);
            $data['post']->content = (object) array_merge((array) $data['meta'], (array) $data['post']->content);
        }

        return view('claws::admin.post-create',$data);
    }

    public function slugGen($name, $type){
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

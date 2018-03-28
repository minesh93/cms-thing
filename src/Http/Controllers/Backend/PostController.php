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
        $post->content = json_encode($request->input('content'));
        if(empty($post->slug)){
            $post->slug = $this->slugGen($request);
        }

        $post->save();
        $post->meta = [];

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
            $data['post']->content = json_decode($data['post']->content);
        }

        return view('claws::admin.post-create',$data);
    }

    public function slugGen(Request $request){
        return $this->createSlug($request->input('name'),$request->input('type'));
    }

    public function createSlug($text,$type){
        $register = PostRegister::getRegisteredPost($type);
        $slug = $register->urlBase . str_slug($text);
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

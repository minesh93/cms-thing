<?php

namespace Claws\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Claws\Models\Post;
use Auth;
use PermissionRegister;

class SiteController extends Controller {

    public function getPost(Request $request, $slug) {

        $post = Post::where('slug' , $slug)->get()->first();
        $post->content = json_decode($post->content);
        
        if(!$post){
            return response(':(',404);
        }

        //- Add template selection after use type for now.
        if(view()->exists("claws.site.{$post->type}")){
            return view("claws.site.{$post->type}", ['post' => $post]); 
        } else {
            return response('Some fancy error about a template not being found',500);
        }


        return view('claws::admin.role-list',['roles'=>$roles]);
    }

}
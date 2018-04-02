<?php

namespace Claws\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Claws\Models\Post;
use Auth;
use PostRegister;

class SiteController extends Controller {

    public function getPost(Request $request, $slug = '') {

        $post = Post::where('slug' , $slug)->get()->first();

        if(!$post){
            return response(':(',404);
        }

        $template = $post->type;

        //- Add template selection after use type for now.
        if(PostRegister::getRegisteredPost($post->type)->useCustomTemplates){
            if($post->template != -1){
                $template = $post->template;
            }
        }
        
        if(view()->exists(config('claws.site_templates').".{$template}")){
            return view(config('claws.site_templates').".{$template}", ['post' => $post]); 
        } else {
            return $this->noTemplateError(config('claws.site_templates').".{$template}");
        }
    }

    public function noTemplateError($template){
        return response("Some fancy error about a template not being found: {$template}",500);
    }

}
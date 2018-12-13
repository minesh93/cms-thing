<?php 
    if (! function_exists('get_posts')) {
        function get_posts($type = null) {
            $posts = Claws\Models\Post::where('type',$type)->get();
            return $posts;
        }
    }
?>
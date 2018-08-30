<?php

namespace Claws\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [];
    protected $hidden = [];

    protected $table = 'claws_post';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    protected $with = [
        'content'
    ];

    public function __construct($name = '',$type = 'page',$attributes = array()) {
        parent::__construct($attributes);
        $this->name = $name;
        $this->type = $type;
    }
    
    public function content() {
        return $this->hasMany('Claws\Models\Content', 'post_id', 'id');
    }

    public function mapContent() {
        $contentArray = [];

        foreach ($this->content as $content) {
            $contentArray[$content->content_key] = (object) $content->content;
        }

        $this->mappedContent = $contentArray;
    }

}

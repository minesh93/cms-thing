<?php

namespace Claws\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [];
    protected $hidden = [];

    protected $table = 'claws_content';

    protected $casts = [
        'content' => 'object',
    ];


    public function content() {
        return $this->belongsTo('Claws\Models\Post', 'id');
    }

}

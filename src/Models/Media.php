<?php

namespace Claws\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    // use ModelValidation;
    protected $fillable = [];
    protected $hidden = [];
    protected static $rules = [];
    protected static $dirtyRules = [];
    protected static $messages = [];

    protected $table = 'claws_media';

    // protected $with = ['creator'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}

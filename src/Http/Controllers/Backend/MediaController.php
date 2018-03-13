<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Claws\Models\Media;
use Auth;
use PermissionRegister;

class MediaController extends Controller {

    public function getMedia() {
        $media = Media::all();
        return $media->toJSON();
    }

}
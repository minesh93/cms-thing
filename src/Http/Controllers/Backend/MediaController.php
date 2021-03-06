<?php

namespace Claws\Http\Controllers\Backend;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Claws\Http\Controllers\Controller;
use Claws\Models\Admin;
use Claws\Models\Role;
use Claws\Models\Media;
use Auth;
use Storage;
use PermissionRegister;

class MediaController extends Controller {

    public function getMedia() {
        $media = Media::all();

        $media->each(function($m) {
            $m->upload_date = $m->created_at->format('jS F Y');
        });

        return $media->toJSON();
    }

    public function uploadMedia(Request $request) {

        $file = $request->file('user-file');

        $media = new Media();
        $media->name = $file->getClientOriginalName();
        $media->title = $file->getClientOriginalName();
        $media->mime = $file->getMimeType();

        $path = Storage::disk('public')->putFile('claws-files', $file);

        $media->path = '/storage/' . $path;
        $media->save();

        $media->upload_date = $media->created_at->format('jS F Y');

        return $media;

    }

    public function updateMedia(Request $request, $id) {

        if(!$id){
            return 'No Media ID';
        }

        $media = Media::find($id);
        $media->title = $request->input('title');
        $media->description = $request->input('description');

        $media->save();

        $media->upload_date = $media->created_at->format('jS F Y');

        return $media;

    }


}
@extends('claws::admin.layout')

@section('content')
    <div class="row between-xs middle-xs">
        <div class="col-xs-9">
            <h1 class="title">
                {{$type->listTitle}}
            </h1>
        </div>
        <div class="col-xs-auto">
            <a href="/admin/content/{{$type->name}}/add" class="button primary full-width large link">{{$type->createText}}</a>
        </div>
    </div>
    <div class="post-list-search">


    </div>
    <div class="post-list-wrap">
        <div class="post-list">
            <div class="row middle-xs post-list-header">
                <div class="col-xs-auto">
                    <div class="checkbox-wrap">
                        <label>
                            <input type="checkbox">
                            <div></div>
                        </label>
                    </div>
                </div>
                <div class="col-xs-8">Name</div>
                <div class="col-xs-1 icon"><i class="far fa-calendar"></i></div>
                <div class="col-xs-2"></div>
            </div>
            @foreach ($posts as $post)
                <div class="row middle-xs post-list-item">
                    <div class="col-xs-auto">
                        <div class="checkbox-wrap">
                            <label>
                                <input type="checkbox">
                                <div></div>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="post-name">
                            <a href='/admin/content/{{$type->name}}/{{$post->id}}'>{{$post->name}}</a>
                        </div>
                        <div class="post-actions">
                            <a href='/{{$post->slug}}'>View</a>
                        </div>
                        </div>
                    <div class="col-xs-1">
                        <div class="post-date">{{$post->updated_at->format('d M Y')}}</div>
                    </div>
                    <div class="col-xs-2">
                        <div class="button-wrap">
                            <a class="button primary link" href='/admin/content/{{$type->name}}/{{$post->id}}'><i class="fas fa-edit"></i> Edit</a>
                            <a class="button danger link"> <i class="fas fa-times"></i> Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
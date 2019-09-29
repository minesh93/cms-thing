@extends('claws::admin.layout')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <h1 class="title">
                {{$type->listTitle}}
            </h1>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-xs-2">
            <a href="/{{ config('claws.admin_url') }}/content/{{$type->name}}/add" class="button primary full-width large link">{{$type->createText}}</a>
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
                <div class="col-xs-1 centered">Created</div>
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
                            <a href="/{{ config('claws.admin_url') }}/content/{{$type->name}}/{{$post->id}}">{{$post->name}}</a>
                        </div>
                        <div class="post-actions">
                            <a href="/{{$post->slug}}">View</a>
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <div class="post-date">{{$post->updated_at->format('d M Y')}}</div>
                    </div>
                    <div class="col-xs-2">
                        <div class="button-wrap">
                            <a class="button primary link" href="/{{ config('claws.admin_url') }}/content/{{$type->name}}/{{$post->id}}"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@extends('claws::admin.layout')

@section('content')
    <div id="app" class="content-wrapper">
		<post-create-edit :mount-p="{{$post->toJSON()}}" :mount-t="{{json_encode($type)}}" :mount-m="{}"></post-create-edit>
    </div>
@endsection
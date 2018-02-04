@extends('claws::admin.layout')

@section('content')
    <div id="app">
		<user-create-edit :mount-u="{{$user->toJSON()}}" :mount-r="{{$roles->toJSON()}}"></user-create-edit>
    </div>
@endsection
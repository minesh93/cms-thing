@extends('claws::admin.layout')

@section('content')
    <div id="app">
		<role-create-edit :mount-r="{{$role->toJSON()}}" :mount-p="{{$permissions->toJSON()}}"></role-create-edit>
    </div>
@endsection
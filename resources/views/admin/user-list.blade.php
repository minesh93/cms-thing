@extends('claws::admin.layout')

@section('content')
	<div class="row between-xs middle-xs user-list-header">
	    <div class="col-xs-9">
	        <h1 class="title">Users</h1>
	    </div>
	    <div class="col-xs-3">
	        <a href="/admin/users/add" class="button primary full-width large">Add New User</a>
	    </div>
	</div>
	<div class="user-list-search">

	</div>
	<div class="user-list-wrap">
		<div class="user-list">
			    <div class="row middle-xs header">
			    	<div class="col-xs checkbox">
			        	<div class="checkbox-wrap">
			        		<label>
			        			<input type="checkbox">
			        			<div></div>
			        		</label>
			        	</div>
			        </div>
			        <div class="col-xs-2">Name</div>
			        <div class="col-xs-2">Email</div>
			        <div class="col-xs-1">Role</div>
			        <div class="col-xs-1">-</div>
			        <div class="col-xs-1">-</div>
			        <div class="col-xs-1">-</div>
			        <div class="col-xs-1">-</div>
			        <div class="col-xs-1">-</div>
			        <div class="col-xs-1">-</div>
			    </div>
		    <div class="list-content">
		        @foreach ($admins as $admin)
		            <div class="row middle-xs list-item">

				    	<div class="col-xs checkbox">
				        	<div class="checkbox-wrap">
				        		<label>
				        			<input type="checkbox">
				        			<div></div>
				        		</label>
				        	</div>
				        </div>

		                <div class="col-xs-2">
                			<div class="real-name">{{$admin->first_name}} {{$admin->last_name}}</div>
                			<div class="username">{{$admin->username}}</div>
		                </div>
		                <div class="col-xs-2"><a href="mailto:{{$admin->email}}"><i class="fas fa-at"></i> {{$admin->email}}</a></div>
		                <div class="col-xs-1">-</div>
		                <div class="col-xs-1">
	                        <a class="button primary" href="/admin/users/{{$admin->id}}">Edit</a>
		                </div>
			        	<div class="col-xs-1">-</div>
		            </div>
		        @endforeach
		    </div>
		</div>
	</div>
@endsection
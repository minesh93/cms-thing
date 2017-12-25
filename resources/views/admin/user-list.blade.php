@extends('claws::admin.layout')

@section('content')
	<div class="row between-xs middle-xs user-list-header">
	    <div class="col-xs-9">
	        <h1 class="title">Admins</h1>
	    </div>
	    <div class="col-xs-3">
	        <a href="/admin/users/add" class="button primary full-width large">Add New User</a>
	    </div>
	</div>
	<div class="user-list-search">

	</div>
	<div class="user-list-wrap">
		<table class="user-list">
		    <thead>
			    <tr class="row">
			        <th class="col-xs-2">Name</th>
			        <th class="col-xs-2">Email</th>
			        <th class="col-xs-1">Role</th>
			        <th class="col-xs-1">-</th>
			        <th class="col-xs-1">-</th>
			        <th class="col-xs-1">-</th>
			    </tr>
		    </thead>
		    <tbody>
		        @foreach ($admins as $admin)
		            <tr class="row middle-xs">
		                <td class="col-xs-2">
		                	<table class="nested-info">
		                		<tr>
		                			<td class="user-name">{{$admin->username}}</td>
		                		</tr>
		                		<tr>
		                			<td class="user-real-name">{{$admin->first_name}}</td>
		                			<td class="user-real-name">{{$admin->last_name}}</td>
		                		</tr>
		                	</table>
		                </td>
		                <td class="col-xs-2"><a href="mailto:{{$admin->email}}">{{$admin->email}}</a></td>
		                <td class="col-xs-1">-</td>
		                <td class="col-xs-1">
	                        <a class="button primary" href='/admin/user/{{$admin->id}}'">Edit</a>
		                </td>
			        	<td class="col-xs-1">-</td>
		            </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
@endsection
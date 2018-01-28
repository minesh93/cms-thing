@extends('claws::admin.layout')

@section('content')
	<div class="row between-xs middle-xs user-list-header">
	    <div class="col-xs-9">
	        <h1 class="title">Roles</h1>
	    </div>
	    <div class="col-xs-3">
	        <a href="/admin/roles/add" class="button primary full-width large">Create New Role</a>
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
		        <div class="col-xs-4">Name</div>
		        <div class="col-xs-3">Key</div>
		        <div class="col-xs-2"></div>
		    </div>
		    <div class="list-content">
		        @foreach ($roles as $role)
		            <div class="row middle-xs list-item">

				    	<div class="col-xs checkbox">
				        	<div class="checkbox-wrap">
				        		<label>
				        			<input type="checkbox">
				        			<div></div>
				        		</label>
				        	</div>
				        </div>

		                <div class="col-xs-4">
                			{{$role->name}}
		                </div>
		                <div class="col-xs-3">{{$role->key}}</div>
		                <div class="col-xs-1">
	                        <a class="button primary" href='/admin/roles/{{$role->id}}'">Edit</a>
		                </div>
			        	<div class="col-xs-1">-</div>
		            </div>
		        @endforeach
		    </div>
		</div>
	</div>
@endsection
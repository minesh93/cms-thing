@extends('claws::admin.layout')

@section('content')
	<div class="row between-xs middle-xs post-list-header">
	    <div class="col-xs-9">
	        <h1 class="title">
	            {{$type->listTitle}}
	        </h1>
	    </div>
	    <div class="col-xs-3">
	        <a href="/admin/content/{{$type->name}}/add" class="button primary full-width large">{{$type->createText}}</a>
	    </div>
	</div>
	<div class="post-list-search">


	</div>
	<div class="post-list-wrap">
		<table class="post-list">
		    <thead>
			    <tr class="row">
					<th class="col-xs-1">
						<div class="checkbox-wrap">
							<label>
								<input type="checkbox">
								<div></div>
							</label>
						</div>
					</th>
			        <th class="col-xs-6">Name</th>
			        <th class="col-xs-3"></th>
			        <th class="col-xs-1">Edited</th>
			        <th class="col-xs-2"></th>
			    </tr>
		    </thead>
		    <tbody>
		        @foreach ($posts as $post)
		            <tr class="row middle-xs">
		                <td class="col-xs-1"></td>
		                <td class="col-xs-6">
		                	<div class="post-name">{{$post->name}}</div>
		                </td>
		                <td class="col-xs-3"></td>
		                <td class="col-xs-1">{{$post->updated_at->format('d/m/Y')}}</td>
		                <td class="col-xs-2">
		                	<div class="fieldset">
	                        	<a class="button primary full-width" href='/admin/content/{{$type->name}}/{{$post->id}}'">Edit</a>
		                	</div>
		                	<div class="fieldset">
	                        	<a class="button danger full-width">Delete</a>
	                    	</div>
		                </td>
		            </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
@endsection
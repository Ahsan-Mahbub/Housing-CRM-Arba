@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>"{{$project->project_name}}" Flat List</b></h3>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Project Name &nbsp;</th>
	                        <th class="text-center">Flat Name &nbsp;</th>
	                        <th class="text-center">Size &nbsp;</th>
	                        <th class="text-center">Facing &nbsp;</th>
	                        <th class="text-center">Confirmation &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($flats as $flat)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$flat->project ? $flat->project->project_name : 'N/a'}}</td>
		                	<td class="text-center">{{$flat->flat_name}}</td>
		                	<td class="text-center">{{$flat->size}}</td>
		                	<td class="text-center">{{$flat->facing}}</td>
		                	<td class="text-center">
		                		@if($flat->confirmattion == 1)
		                			<span class="badge badge-success">Sold</span>
		                		@else
		                			<span class="badge badge-danger">Unsold</span>
		                		@endif
		                	</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>

@endsection
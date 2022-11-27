@extends('backend.layouts.app')
@section('content')
<style type="text/css">
    .block-content p {
        margin-bottom: 13px;
    }
    .font-w700{
        margin-bottom: 8px;
    }
    .text-title {
        color: #3d7000!important;
        font-weight: 800;
    }
</style>
<div class="container">
	<div class="text-right">
		@if($assign->flat->confirmattion == 1)
	    <h4 class="text-warning font-w700"> "{{$assign->flat->flat_name}}" allready sold</h4>
	    @else
	    <div class="btn-group" role="group" aria-label="Third group">
	        <button type="button" class="btn btn-alt-info mr-5 mb-5 dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flat Type Status</button>
	        <div class="dropdown-menu" aria-labelledby="toolbarDrop" style="">
	            @foreach($types as $type)
	            <a class="dropdown-item text-dark" href="{{url('admin/flat-assign/status/'.$assign->id.'?type_id='.$type->id)}}">
	                {{$type->type_name}}
	            </a>
	            @endforeach
	        </div>
	    </div>
	    @endif
	</div>
    <div class="row justify mt-3">
    	<div class="col-xl-6 single-filed">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title text-white">Customer Information</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="pt-2 col-12">
                                	<p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Managed By: </strong>{{$customer->user ? $customer->user->name : 'Not Set'}}</p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Create Date: </strong>
		                                <?php
		                                    $c_date = date('j F Y',strtotime($customer->created_at))
		                                ?>
		                                {{$c_date}}
		                            </p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Refference: </strong>{{$customer->reference? $customer->reference->reference_name : 'N/A'}}</p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Follow Up Time : </strong>
		                                @if($customer->remember_time) 
		                                <?php
		                                    $date = date('j F Y',strtotime($customer->remember_time))
		                                ?>
		                                {{$date}}
		                                @endif
		                            </p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Name: </strong>{{$customer->customer_name}}</p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Mobile Number: </strong>{{$customer->phone}}</p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Email: </strong>{{$customer->email}}</p>
		                            <p class="text-primary-darker d-block font-w600"><strong class="text-title">Customer Address: </strong>{{$customer->address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 single-filed">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title text-white">Flat Information</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="pt-2 col-12">
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Project Name: </strong>{{$assign->project ? $assign->project->project_name : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Flat Name: </strong>{{$assign->flat ? $assign->flat->flat_name : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Flat Size: </strong>{{$assign->flat ? $assign->flat->size : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Bedroom: </strong>{{$assign->flat ? $assign->flat->bedroom : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Bathroom: </strong>{{$assign->flat ? $assign->flat->bathroom : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Unit: </strong>{{$assign->flat ? $assign->flat->unit : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Drawing: </strong>{{$assign->flat ? $assign->flat->drawing : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Dining: </strong>{{$assign->flat ? $assign->flat->dining : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Balcony: </strong>{{$assign->flat ? $assign->flat->balcony : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Floor: </strong>{{$assign->flat ? $assign->flat->floor : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Parking: </strong>{{$assign->flat ? $assign->flat->parking : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Basement: </strong>{{$assign->flat ? $assign->flat->basement : 'N/A'}}</p>
                                    <p class="text-primary-darker d-block font-w600"><strong class="text-title">Facing: </strong>{{$assign->flat ? $assign->flat->facing : 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
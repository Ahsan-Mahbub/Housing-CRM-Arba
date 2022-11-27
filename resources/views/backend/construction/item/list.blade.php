@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Item Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Item
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Unit Name &nbsp;</th>
	                        <th class="text-center">Item Name &nbsp;</th>
	                        <!-- <th class="text-center">Price &nbsp;</th> -->
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($items as $item)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$item->unit->unit_name}}</td>
		                	<td class="text-center">{{$item->item_name}}</td>
		                	<!-- <td class="text-center">{{$item->price}}</td> -->
		                	<td class="text-center">
		                		@if($item->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('item.delete',$item->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('item.status',$item->id)}}" class="btn btn-circle mr-5 mb-5 {{$item->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$item->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
			                		<a href="{{route('item.edit',$item->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
		                                <i class="fa fa-edit"></i>
		                            </a>
	                                @csrf
	                                @method('delete')
	                               <button type="submit" class="btn btn-circle btn-alt-danger mr-5 mb-5 delete-confirm">
		                                <i class="fa fa-trash-o"></i>
		                            </button>
	                            </form>
		                	</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>

<!-- item add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Item</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<div class="form-group row">
	                            <label class="col-12" for="item">Select Unit: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                            	<select class="form-control" name="unit_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($units as $unit)
	                                	<option value="{{$unit->id}}">{{$unit->unit_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-12" for="item">Item Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" name="item_name" required placeholder="Item Name..">
	                            </div>
	                        </div>
	                        <!-- <div class="form-group row">
	                            <label class="col-12" for="item">Price: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="number" min="1" class="js-autocomplete form-control" name="price" required placeholder="Price..">
	                            </div>
	                        </div> -->
	                        <div class="form-group text-right">
	                            <button type="submit" class="btn btn-square btn-primary min-width-125 mb-10 mt-20">Submit</button>
	                        </div>
	                    </form>
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end item add modal -->

@endsection
@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Customer Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Customer
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Customer Name &nbsp;</th>
	                        <th class="text-center">Creator Name &nbsp;</th>
	                        <th class="text-center">Phone &nbsp;</th>
	                        <th class="text-center">Email &nbsp;</th>
	                        <th class="text-center">Address &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($customers as $customer)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$customer->customer_name}}</td>
	                		<td class="text-center">{{$customer->user ? $customer->user->name : 'N/A'}}</td>
		                	<td class="text-center">{{$customer->phone}}</td>
		                	<td class="text-center">{{$customer->email}}</td>
		                	<td class="text-center">{{$customer->address}}</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('customer.delete',$customer->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('customer.show',$customer->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
		                                <i class="fa fa-eye"></i>
		                            </a>
			                		<a href="{{route('customer.edit',$customer->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
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

<!-- flat add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Customer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                        <div class="form-group row">
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Customer Name:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="customer_name" required placeholder="Customer Name..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Phone:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="phone" placeholder="Phone..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Email:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="email" placeholder="Email..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Address:</label>
		                            <div class="col-lg-12">
		                                <textarea class="js-autocomplete form-control" name="address" placeholder="Address.."></textarea>
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Reference:</label>
		                            <div class="col-lg-12">
		                                <select class="form-control" name="reference_id">
		                                	<option value="">Please select</option>
		                                	@foreach($references as $reference)
		                                	<option value="{{$reference->id}}">{{$reference->reference_name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Remember Time:</label>
		                            <div class="col-lg-12">
		                                <input type="date" class="js-autocomplete form-control" name="remember_time">
		                            </div>
	                            </div>
	                            <div class="col-md-12 pt-2">
	                            	<label class="col-12" for="status">Primary Note:</label>
		                            <div class="col-lg-12">
		                                <textarea class="js-autocomplete form-control" rows="5" name="notes" placeholder="Note.."></textarea>
		                            </div>
	                            </div>
		                    </div>
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
<!-- end flat add modal -->
@endsection
@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Customer Update</h3>
                    <div class="block-options">
                        <a href="{{route('customer.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Customer List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('customer.update',$customer->id)}}" method="post" enctype="multipart/form-data">
	                    @csrf
                        <div class="form-group row">
                        	<div class="col-md-6 pt-2">
                            	<label class="col-12" for="status">Customer Name:</label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" value="{{$customer->customer_name}}" name="customer_name" required placeholder="Customer Name..">
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
                            	<label class="col-12" for="status">Phone:</label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" value="{{$customer->phone}}" name="phone" placeholder="Phone..">
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
                            	<label class="col-12" for="status">Email:</label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" value="{{$customer->email}}" name="email" placeholder="Email..">
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
                            	<label class="col-12" for="status">Reference:</label>
	                            <div class="col-lg-12">
	                                <select class="form-control" name="reference_id">
	                                	<option value="">Please select</option>
	                                	@foreach($references as $reference)
	                                	<option value="{{$reference->id}}" {{$customer->reference_id == $reference->id ? 'selected' : ''}}>{{$reference->reference_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-12 pt-2">
                            	<label class="col-12" for="status">Address:</label>
	                            <div class="col-lg-12">
	                                <textarea class="js-autocomplete form-control" name="address" placeholder="Address..">{{$customer->address}}</textarea>
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
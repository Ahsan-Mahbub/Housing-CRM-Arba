@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Status Wise Customer Report Table</b></h3>
	    	<button type="button" class="btn-block-option" onclick="printDiv('printableArea')">
                <i class="si si-printer"></i> Print List
            </button>
	    </div>
	    <div class="block-content block-content-full" id="printableArea">
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
	                            <a href="{{route('customer.show',$customer->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
	                                <i class="fa fa-eye"></i>
	                            </a>
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
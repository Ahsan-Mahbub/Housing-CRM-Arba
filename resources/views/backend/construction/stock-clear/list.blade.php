@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Stock Clear Table</b></h3>
	        <a href="{{route('stock.clear.create')}}" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Stock Clear
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Stock Purchase Code &nbsp;</th>
	                        <th class="text-center">Item Name &nbsp;</th>
	                        <th class="text-center">Clear Quantity &nbsp;</th>
	                        <th class="text-center">Used Item Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($stock_clears as $clear)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$clear->stock->purchase_code}}</td>
		                	<td class="text-center">{{$clear->item->item_name}}</td>
		                	<td class="text-center">{{$clear->clear_qty}}</td>
		                	<td class="text-center">{{$clear->clear_qty_price}}</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
@endsection
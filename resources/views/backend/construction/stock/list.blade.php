@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Stock Table</b></h3>
	        <a href="{{route('stock.create')}}" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Stock
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">Supplier &nbsp;</th>
	                        <th class="text-center">Project &nbsp;</th>
	                        <th class="text-center">Purchase Code &nbsp;</th>
	                        <th class="text-center">Total &nbsp;</th>
	                        <th class="text-center">Grand Total &nbsp;</th>
	                        <th class="text-center">Paid &nbsp;</th>
	                        <th class="text-center">Due &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($stocks as $stock)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$stock->date}}</td>
		                	<td class="text-center">{{$stock->supplier->supplier_name}}</td>
		                	<td class="text-center">{{$stock->project->project_name}}</td>
		                	<td class="text-center">{{$stock->purchase_code}}</td>
		                	<td class="text-center">{{$stock->total_price}}</td>
		                	<td class="text-center">{{$stock->grand_total}}</td>
		                	<td class="text-center">{{$stock->paid_amount}}</td>
		                	<td class="text-center">{{$stock->due}}</td>
		                	<td class="text-center icon-statte">
		                		<a href="{{route('stock.show',$stock->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5"><i class="fa fa-eye"></i></a>
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
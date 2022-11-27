@extends('backend.layouts.app')
@section('content')
<style type="text/css">
	.header-div{
		background: #6a6a6c;
	    color: #fff;
	    font-size: 15px;
	    padding: 5px;
	    line-height: inherit;
	    margin-bottom: 10px;
	}
</style>
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>View Stock Details</b></h3>
	    </div>
	    <div class="block-content block-content-full">
		    <div class="row justify">
		    	<div class="col-md-3">
		    		<p><strong>Supplier Name : </strong>{{$stock->supplier ? $stock->supplier->supplier_name : 'N/A'}}</p>
		    		<p><strong>Project Name : </strong>{{$stock->project ? $stock->project->project_name : 'N/A'}}</p>
		        </div>
	          	<div class="col-md-3">
	          		<p><strong>Date : </strong>{{$stock->date}}</p>
	          		<p><strong>Purchase Code : </strong>{{$stock->purchase_code}}</p>
	      		</div>
	      		<div class="col-md-3">
	      			<p><strong>Total Price : </strong>{{$stock->total_price}}</p>
	      			<p><strong>Transection + Other Cost : </strong>{{$stock->transprotation_cost}}</p>
	      		</div>
	      		<div class="col-md-3">
	      			<p class="font-w700 text-success"><strong>Paid Amount : </strong>{{$stock->paid_amount}}</p>
	      			<p class="font-w700 text-danger"><strong>Due Amount : </strong>{{$stock->due}}</p>
	      		</div>
	        </div>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="text-center header-div">
            	<label class="text-center font-w600 m-1">Items Details</label>
            </div>
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Stock Purchase Code &nbsp;</th>
	                        <th class="text-center">Item Name &nbsp;</th>
	                        <th class="text-center">Purchase Price &nbsp;</th>
	                        <th class="text-center">Qty &nbsp;</th>
	                        <th class="text-center">Discount &nbsp;</th>
	                        <th class="text-center">Sub Total &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($items as $item)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$item->stock ? $item->stock->purchase_code : 'N/A'}}</td>
		                	<td class="text-center">{{$item->item->item_name}}</td>
		                	<td class="text-center">{{$item->purchase_price}}</td>
		                	<td class="text-center">{{$item->qty}}</td>
		                	<td class="text-center">{{$item->discount}}</td>
		                	<td class="text-center">{{$item->sub_total}}</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="text-center header-div">
            	<label class="text-center font-w600 m-1">Transaction Details</label>
            </div>
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">Stock Purchase Code &nbsp;</th>
	                        <th class="text-center">Method Name &nbsp;</th>
	                        <th class="text-center">Account Name &nbsp;</th>	                        
	                        <th class="text-center">Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($transactions as $transaction)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$transaction->date}}</td>
	                		<td class="text-center">{{$transaction->stock ? $transaction->stock->purchase_code : 'N/A'}}</td>
		                	<td class="text-center">{{$transaction->method->name}}</td>
		                	<td class="text-center">{{$transaction->account ? $transaction->account->account_name : 'N/A'}}</td>
		                	<td class="text-center">{{$transaction->amount}}</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
@endsection
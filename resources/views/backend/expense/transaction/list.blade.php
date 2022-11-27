@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Transaction Table</b></h3>
	        <a href="{{route('transaction.create')}}" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Transaction
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">Supplier Name &nbsp;</th>
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
	                		<td class="text-center">{{$transaction->supplier ? $transaction->supplier->supplier_name : 'N/A'}}</td>
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
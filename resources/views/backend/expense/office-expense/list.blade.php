@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Office Expense Table</b></h3>
	        <a href="{{route('fund-withdraw.create')}}" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Office Expense
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">Payment Method &nbsp;</th>
	                        <th class="text-center">Account &nbsp;</th>
	                        <th class="text-center">Reason &nbsp;</th>
	                        <th class="text-center">Trx. Details &nbsp;</th>
	                        <th class="text-center">Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($expenses as $expense)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$expense->date}}</td>
		                	<td class="text-center">{{$expense->method ? $expense->method->name : 'N/A'}}</td>
		                	<td class="text-center">{{$expense->account ? $expense->account->account_name : 'N/A'}}</td>
		                	<td class="text-center">{{$expense->reason}}</td>
		                	<td class="text-center">{{$expense->trx_details}}</td>
		                	<td class="text-center">{{$expense->amount}}</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
@endsection
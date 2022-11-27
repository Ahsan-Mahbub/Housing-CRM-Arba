@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Fund Withdraw Table</b></h3>
	        <a href="{{route('fund-withdraw.create')}}" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Fund Withdraw
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">User Name &nbsp;</th>
	                        <th class="text-center">Payment Method &nbsp;</th>
	                        <th class="text-center">Account &nbsp;</th>
	                        <th class="text-center">Reason &nbsp;</th>
	                        <th class="text-center">Trx. Details &nbsp;</th>
	                        <th class="text-center">Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($withdraws as $withdraw)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$withdraw->date}}</td>
		                	<td class="text-center">{{$withdraw->user ? $withdraw->user->name : 'N/A'}}</td>
		                	<td class="text-center">{{$withdraw->method ? $withdraw->method->name : 'N/A'}}</td>
		                	<td class="text-center">{{$withdraw->account ? $withdraw->account->account_name : 'N/A'}}</td>
		                	<td class="text-center">{{$withdraw->reason}}</td>
		                	<td class="text-center">{{$withdraw->trx_details}}</td>
		                	<td class="text-center">{{$withdraw->amount}}</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
@endsection
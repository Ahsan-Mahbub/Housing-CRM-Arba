@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Fund Report Table</b></h3>
	    	<button type="button" class="btn-block-option" onclick="printDiv('printableArea')">
                <i class="si si-printer"></i> Print List
            </button>
	    </div>
	    <div class="block-content block-content-full" id="printableArea">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Date &nbsp;</th>
	                        <th class="text-center">Category &nbsp;</th>
	                        <th class="text-center">User Name &nbsp;</th>
	                        <th class="text-center">Payment Method &nbsp;</th>
	                        <th class="text-center">Account &nbsp;</th>
	                        <th class="text-center">Reason &nbsp;</th>
	                        <th class="text-center">Trx. Details &nbsp;</th>
	                        <th class="text-center">Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; $total = 0;@endphp
                    	@foreach($funds as $fund)
                    	@php 
                          $total+=$fund->amount;
                    	@endphp 
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$fund->date}}</td>
		                	<td class="text-center">{{$fund->category ? $fund->category->name : 'N/A'}}</td>
		                	<td class="text-center">{{$fund->user ? $fund->user->name : 'N/A'}}</td>
		                	<td class="text-center">{{$fund->method ? $fund->method->name : 'N/A'}}</td>
		                	<td class="text-center">{{$fund->account ? $fund->account->account_name : 'N/A'}}</td>
		                	<td class="text-center">{{$fund->reason}}</td>
		                	<td class="text-center">{{$fund->trx_details}}</td>
		                	<td class="text-center">{{$fund->amount}}</td>
	                	</tr>
	                	@endforeach
	                	<tr>
                            <td colspan="8" class="font-w700 text-right">Total</td>
                            <td class="font-w700 text-center">{{$total}}</td>
                        </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
@endsection
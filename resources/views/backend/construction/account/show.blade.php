@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-md-10">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Account Details</b></h3>
			    </div>
			    <div class="row">
			    	<div class="col-md-7">
			    		<div class="block-content block-content-full">
						    <div class="row justify">
						    	<div class="col-md-6">
						    		<p><strong>Account Name : </strong>{{$account->account_name}}</p>
						    		<p><strong>Account Number : </strong>{{$account->number}}</p>
						        </div>
						        <div class="col-md-6">
					          		<p><strong>Branch : </strong>{{$account->branch}}</p>
						    		<p><strong>Details : </strong>{{$account->details}}</p>
						        </div>
					        </div>
					    </div>
			    	</div>
			    	<div class="col-md-5 m-auto">
			    		<a class="block block-link-pop text-right bg-primary m-0">
							<div class="block-content block-content-full clearfix border-black-op-b border-3x">
								<div class="float-left mt-10 d-none d-sm-block">
									<i class="si si-bar-chart fa-3x text-primary-light"></i>
								</div>
								<div class="font-size-h3 font-w600 text-white js-count-to-enabled">
									<span class="num">{{$account->blance}}</span>
								</div>
								<div class="font-size-sm font-w600 text-uppercase text-white-op">Total Blance</div>
							</div>
						</a>
			    	</div>
			    </div>
			</div>
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Account Transaction Table</b></h3>
			    </div>
			    <div class="block-content block-content-full">
			    	<div class="table table-responsive">
			            <table class="table table-bordered table-striped table-vcenter">
			                <thead>
			                    <tr>
			                        <th class="text-center">S/L &nbsp;</th>
			                        <th class="text-center">Date &nbsp;</th>
			                        <th class="text-center">Transaction Amount &nbsp;</th>
			                        <th class="text-center">Type &nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@php $sl = 1; @endphp
		                    	@foreach($transactions as $transaction)
			                	<tr>
			                		<td class="text-center">{{$sl++}}</td>
				                	<td class="text-center">{{$transaction->date}}</td>
				                	<td class="text-center">{{$transaction->amount}}</td>
				                	<td class="text-center" style="text-transform: capitalize;">
				                		@if($transaction->type == 'fund')
				                		<span class="badge badge-success">{{$transaction->type}}</span>
				                		@else
				                		<span class="badge badge-danger">{{$transaction->type}}</span>
				                		@endif
				                	</td>
			                	</tr>
			                	@endforeach
			                </tbody>
			            </table>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
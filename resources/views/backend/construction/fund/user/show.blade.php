@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>User Details</b></h3>
			    </div>
			    <div class="block-content block-content-full">
				    <div class="row justify">
				    	<div class="col-md-4">
				    		<p><strong>User Name : </strong>{{$user->name}}</p>
				    		<p><strong>Email : </strong>{{$user->email}}</p>
				        </div>
			          	<div class="col-md-4">
			          		<p><strong>Phone : </strong>{{$user->phone}}</p>
			          		<p><strong>Address : </strong>{{$user->address}}</p>
			      		</div>
			        </div>
			    </div>
			</div> 
			<div class="row">
				<div class="col-6 col-xl-4">
					<a class="block block-link-pop text-right bg-primary">
						<div class="block-content block-content-full clearfix border-black-op-b border-3x">
							<div class="float-left mt-10 d-none d-sm-block">
								<i class="si si-bar-chart fa-3x text-primary-light"></i>
							</div>
							<div class="font-size-h3 font-w600 text-white js-count-to-enabled">
								<span class="num">
									{{$total_fund}}
								</span>
							</div>
							<div class="font-size-sm font-w600 text-uppercase text-white-op">Total Fund</div>
						</div>
					</a>
				</div>
				<div class="col-6 col-xl-4">
					<a class="block block-link-pop text-right bg-dark">
						<div class="block-content block-content-full clearfix border-black-op-b border-3x">
							<div class="float-left mt-10 d-none d-sm-block">
								<i class="si si-bar-chart fa-3x text-primary-light"></i>
							</div>
							<div class="font-size-h3 font-w600 text-white js-count-to-enabled">
								<span class="num">
									{{$total_withdraw}}
								</span>
							</div>
							<div class="font-size-sm font-w600 text-uppercase text-white-op">Total Fund Withdraw</div>
						</div>
					</a>
				</div>
				<div class="col-6 col-xl-4">
					<a class="block block-link-pop text-right bg-primary">
						<div class="block-content block-content-full clearfix border-black-op-b border-3x">
							<div class="float-left mt-10 d-none d-sm-block">
								<i class="si si-bar-chart fa-3x text-primary-light"></i>
							</div>
							<div class="font-size-h3 font-w600 text-white js-count-to-enabled">
								<span class="num">
									{{$total_fund - $total_withdraw}}
								</span>
							</div>
							<div class="font-size-sm font-w600 text-uppercase text-white-op">Now Deposited Fund</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Fund Table</b></h3>
			    </div>
			    <div class="block-content block-content-full">
			    	<div class="table table-responsive">
			            <table class="table table-bordered table-striped table-vcenter">
			                <thead>
			                    <tr>
			                        <th class="text-center">S/L &nbsp;</th>
			                        <th class="text-center">Date &nbsp;</th>
			                        <th class="text-center">Category &nbsp;</th>
			                        <th class="text-center">Payment Method &nbsp;</th>
			                        <th class="text-center">Account &nbsp;</th>
			                        <th class="text-center">Amount &nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@php $sl = 1; @endphp
		                    	@foreach($funds as $fund)
			                	<tr>
			                		<td class="text-center">{{$sl++}}</td>
				                	<td class="text-center">{{$fund->date}}</td>
				                	<td class="text-center">{{$fund->user ? $fund->user->name : 'N/A'}}</td>
				                	<td class="text-center">{{$fund->method ? $fund->method->name : 'N/A'}}</td>
				                	<td class="text-center">{{$fund->account ? $fund->account->account_name : 'N/A'}}</td>
				                	<td class="text-center">{{$fund->amount}}</td>
			                	</tr>
			                	@endforeach
			                </tbody>
			            </table>
			        </div>
			    </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="block">
			    <div class="block-header block-header-default">
			        <h3 class="block-title text-white"><b>Fund Withdraw Table</b></h3>
			    </div>
			    <div class="block-content block-content-full">
			    	<div class="table table-responsive">
			            <table class="table table-bordered table-striped table-vcenter">
			                <thead>
			                    <tr>
			                        <th class="text-center">S/L &nbsp;</th>
			                        <th class="text-center">Date &nbsp;</th>
			                        <th class="text-center">Payment Method &nbsp;</th>
			                        <th class="text-center">Account &nbsp;</th>
			                        <th class="text-center">Amount &nbsp;</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@php $sl = 1; @endphp
		                    	@foreach($withdraws as $withdraw)
			                	<tr>
			                		<td class="text-center">{{$sl++}}</td>
				                	<td class="text-center">{{$withdraw->date}}</td>
				                	<td class="text-center">{{$withdraw->method ? $withdraw->method->name : 'N/A'}}</td>
				                	<td class="text-center">{{$withdraw->account ? $withdraw->account->account_name : 'N/A'}}</td>
				                	<td class="text-center">{{$withdraw->amount}}</td>
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
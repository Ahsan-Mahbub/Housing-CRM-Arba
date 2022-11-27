@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Account Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Account
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Method Name &nbsp;</th>
	                        <th class="text-center">Account Name &nbsp;</th>
	                        <th class="text-center">Number &nbsp;</th>
	                        <th class="text-center">Branch &nbsp;</th>
	                        <th class="text-center">Blance &nbsp;</th>
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($accounts as $account)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$account->method->name}}</td>
		                	<td class="text-center">{{$account->account_name}}</td>
		                	<td class="text-center">{{$account->number}}</td>
		                	<td class="text-center">{{$account->branch}}</td>
		                	<td class="text-center">{{$account->blance}}</td>
		                	<td class="text-center">
		                		@if($account->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('account.delete',$account->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('account.status',$account->id)}}" class="btn btn-circle mr-5 mb-5 {{$account->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$account->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
		                            <a href="{{route('account.show',$account->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
		                                <i class="fa fa-eye"></i>
		                            </a>
			                		<a href="{{route('account.edit',$account->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
		                                <i class="fa fa-edit"></i>
		                            </a>
	                                @csrf
	                                @method('delete')
	                               <button type="submit" class="btn btn-circle btn-alt-danger mr-5 mb-5 delete-confirm">
		                                <i class="fa fa-trash-o"></i>
		                            </button>
	                            </form>
		                	</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>

<!-- account add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Account</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('account.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<div class="form-group row">
	                            <div class="col-md-6 pb-2">
	                            	<label for="account">Select Payment Method: <span class="text-danger">*</span></label>
		                            <div>
		                            	<select class="form-control" name="method_id" required="">
		                                	<option value="">Please select</option>
		                                	@foreach($methods as $method)
		                                	<option value="{{$method->id}}">{{$method->name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-6 pb-2">
	                            	<label for="account">Account Name: <span class="text-danger">*</span></label>
		                            <div>
		                                <input type="text" class="js-autocomplete form-control" name="account_name" required placeholder="Account Name..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pb-2">
	                            	<label for="account">Account Number: </label>
		                            <div>
		                                <input type="text" class="js-autocomplete form-control" name="number" placeholder="Account Number..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pb-2">
	                            	<label for="account">Account Branch: </label>
		                            <div>
		                                <input type="text" class="js-autocomplete form-control" name="branch" placeholder="Account Branch..">
		                            </div>
	                            </div>
	                        </div>
	                        <div class="form-group text-right">
	                            <button type="submit" class="btn btn-square btn-primary min-width-125 mb-10 mt-20">Submit</button>
	                        </div>
	                    </form>
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end account add modal -->

@endsection
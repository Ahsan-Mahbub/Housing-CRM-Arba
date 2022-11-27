@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Fund Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Fund
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
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
	                	@php $sl = 1; @endphp
                    	@foreach($funds as $fund)
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
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>

<!-- fund add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Fund</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('fund.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<div class="form-group row">
	                    		<div class="col-md-4 pb-2">
	                            	<label for="fund">Date: </label>
		                            <div>
		                            	<?php
		                            		$today_date = date("jS F Y");
		                            	?>
		                            	<input disabled="" class="js-autocomplete form-control" value="{{$today_date}}">
		                                <input type="hidden" class="js-autocomplete form-control" name="date" value="{{$today_date}}">
		                            </div>
	                            </div>
	                            <div class="col-md-4 pb-2">
	                            	<label for="fund">Select Fund Category: <span class="text-danger">*</span></label>
		                            <div>
		                            	<select class="form-control" name="category_id" required="">
		                                	<option value="">Please select</option>
		                                	@foreach($categories as $category)
		                                	<option value="{{$category->id}}">{{$category->name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-4 pb-2">
	                            	<label for="fund">Select Fund User: <span class="text-danger">*</span></label>
		                            <div>
		                            	<select class="form-control" name="user_id" required="">
		                                	<option value="">Please select</option>
		                                	@foreach($users as $user)
		                                	<option value="{{$user->id}}">{{$user->name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-4 pb-2">
	                            	<label for="status">Payment Method: <span class="text-danger">*</span></label>
		                            <div>
		                                <select class="form-control" name="method_id" id="method_id" required="" onchange="getAccount()">
		                                	<option value="">Please select</option>
		                                	@foreach($methods as $method)
		                                	<option value="{{$method->id}}">{{$method->name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-4 pb-2">
	                            	<label for="status">Account Name: <span class="text-danger">*</span></label>
		                            <div>
		                                <select class="form-control" id="account_id" name="account_id" required="">
		                                	<option value="">Please select</option>
		                                </select>
		                            </div>
	                            </div>
	                            <div class="col-md-4 pb-2">
	                            	<label for="fund">Amount: <span class="text-danger">*</span></label>
		                            <div>
		                                <input type="number" class="js-autocomplete form-control" name="amount" placeholder="Amount..." required>
		                            </div>
	                            </div>
	                            <div class="col-md-6 pb-2">
	                            	<label for="fund">Reason: </label>
		                            <div>
		                                <textarea class="js-autocomplete form-control" name="reason" rows="3" placeholder="Reason of Fund.."></textarea>
		                            </div>
	                            </div>
	                            <div class="col-md-6 pb-2">
	                            	<label for="fund">Transaction Details:</label>
		                            <div>
		                                <textarea class="js-autocomplete form-control" name="trx_details" rows="3" placeholder="Transaction Details.."></textarea>
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
<!-- end fund add modal -->
@endsection
@section('script')
<script type="text/javascript">
	function getAccount(){
	    let id = $("#method_id").val();
	    let url = '/admin/method/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            let html = '';
	            //console.log(response)
	            html+='<option value="">Please select</option>'
	            response.forEach(element => {
	                html+='<option value='+element.id+'>'+element.account_name+'-'+element.number+'</option>'
	            });
	            $("#account_id").html(html);

	        }
	    });
	}
</script>
@endsection
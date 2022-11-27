@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-11 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Withdraw Fund</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('fund-withdraw.store')}}" method="post">
                    	@csrf
                    	<div class="form-group row justify">
                    		<div class="col-md-4 pb-2">
                            	<label for="fund">Select Fund User: <span class="text-danger">*</span></label>
	                            <div>
	                            	<select class="form-control" name="user_id" id="user_id" required="" onchange="getUserInfo()">
	                                	<option value="">Please select</option>
	                                	@foreach($users as $user)
	                                	<option value="{{$user->id}}">{{$user->name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-12 text-center font-w700 text-success pb-2 pt-2">
                            	<div id="user-info">
                            		
                            	</div>
                            </div>
                    	</div>
                        <div class="form-group row">
                    		<div class="col-md-3 pb-2">
                            	<label for="fund">Date: </label>
	                            <div>
	                            	<?php
	                            		$today_date = date("jS F Y");
	                            	?>
	                            	<input disabled="" class="js-autocomplete form-control" value="{{$today_date}}">
	                                <input type="hidden" class="js-autocomplete form-control" name="date" value="{{$today_date}}">
	                            </div>
                            </div>
                            <div class="col-md-3 pb-2">
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
                            <div class="col-md-3 pb-2">
                            	<label for="status">Account Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" id="account_id" name="account_id" required="">
	                                	<option value="">Please select</option>
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-3 pb-2">
                            	<label for="fund">Withdraw Amount: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" class="js-autocomplete form-control" name="amount" placeholder="Amount..." required>
	                            </div>
                            </div>
                            <div class="col-md-6 pb-2">
                            	<label for="fund">Reason: </label>
	                            <div>
	                                <textarea class="js-autocomplete form-control" name="reason" rows="3" placeholder="Reason of Withdraw.."></textarea>
	                            </div>
                            </div>
                            <div class="col-md-6 pb-2">
                            	<label for="fund">Transaction Details:</label>
	                            <div>
	                                <textarea class="js-autocomplete form-control" name="trx_details" rows="3" placeholder="Transaction Details.."></textarea>
	                            </div>
                            </div>
                        </div>

                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
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

	function getUserInfo(){
	    let id = $("#user_id").val();
	    let url = '/admin/user-info/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            let html = '';
	            html = '<span>User Fund Amount : '+response+'</span>'
	            $("#user-info").html(html);
	        }
	    });
	}
</script>
@endsection
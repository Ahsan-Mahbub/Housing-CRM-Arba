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
	<div class="row justify">
		<div class="col-xl-12 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Add Stock</h3>
                    <div class="block-options">
                        <a href="{{route('stock.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Stock List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('stock.store')}}" method="post" enctype="multipart/form-data">
	                    @csrf

	                    <div class="text-center header-div">
	                    	<label class="text-center font-w600 m-1" style="text-transform: uppercase;">Basic Information</label>
	                    </div>

                        <div class="form-group row">
                            <div class="col-md-4 pt-2">
                            	<label for="status">Supplier Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="supplier_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($suppliers as $supplier)
	                                	<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-4 pt-2">
                            	<label for="status">Project Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="project_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($projects as $project)
	                                	<option value="{{$project->id}}">{{$project->project_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-4 pt-2">
	                            <label for="item">Date: <span class="text-danger">*</span></label>
	                            <div>
	                            	<?php
	                            		$today_date = date("jS F Y");
	                            	?>
	                                <input type="text" class="js-autocomplete form-control" value="{{$today_date}}" disabled="">
	                                <input type="hidden" class="js-autocomplete form-control" value="{{$today_date}}" name="date" required>
	                            </div>
	                        </div>
	                        <div class="col-md-4 pt-2">
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
                            <div class="col-md-4 pt-2">
                            	<label for="status">Account Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" id="account_id" name="account_id" required="">
	                                	<option value="">Please select</option>
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-4 pt-2">
	                            <label for="item">Purchase Code: <span class="text-danger">*</span></label>
	                            <div>
	                            	<?php
	                            	if($purchase_code){
	                            		$replace_purchase_code = $purchase_code->id+1;
	                            	}else{
	                            		$replace_purchase_code = 1;
	                            	}
	                            	?>
	                                <input type="text" class="js-autocomplete form-control" value="s-pc-{{$replace_purchase_code}}" disabled="">
	                                <input type="hidden" class="js-autocomplete form-control" value="s-pc-{{$replace_purchase_code}}" name="purchase_code" required>
	                            </div>
	                        </div>
                        </div>

                        <div class="text-center header-div">
                        	<label class="text-center font-w600 m-1" style="text-transform: uppercase;">Purchase Items</label>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-5 pt-2">
                            	<label for="status">Select Item: <span class="text-danger">*</span></label>
	                            <div>
	                            	<select class="form-control" name="item_id" id="item_id" required="" onchange="addMore()">
	                                	<option value="" disabled="" selected="">Please select</option>
	                                	@foreach($items as $item)
	                                	<option value="{{$item->id}}">{{$item->item_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="block-content block-content-full">
                            	<div class="table table-responsive">
	                            	<table class="table table-bordered">
						                <thead>
						                    <tr>
						                        <th class="text-center">Item Name &nbsp;</th>
						                        <th class="text-center">Purchase Price &nbsp;</th>
						                        <th class="text-center">Quantity &nbsp;</th>
						                        <th class="text-center">Discount &nbsp;</th>
						                        <th class="text-center">Sub Total &nbsp;</th>
						                        <th class="text-center">Action &nbsp;</th>
						                    </tr>
						                </thead>
						                <tbody id="add-div">
						                	
						                </tbody>
						            </table>
	                            </div>
                            </div>
                        </div>

                        <div class="text-center header-div">
                        	<label class="text-center font-w600 m-1" style="text-transform: uppercase;">Transection Information</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 pt-3">
	                            <label for="item">Total Price: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" id="sub_total_price" class="js-autocomplete form-control" disabled="" placeholder="Total Price">
	                                <input type="hidden" id="sub_total_input" class="js-autocomplete form-control" name="total_price" required>
	                            </div>
	                        </div>
	                        <div class="col-md-4 pt-3">
	                            <label for="item">Transportation + Other Cost: </label>
	                            <div>
	                                <input type="number" value="0" id="transprotation_cost" class="js-autocomplete form-control" name="transprotation_cost" placeholder="Transportation Cost" onkeyup="transprotationPrice()">
	                            </div>
	                        </div>
	                        <div class="col-md-4 pt-3">
	                            <label for="item">Grand Total: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" class="js-autocomplete form-control" id="grand_total_price" disabled="" placeholder="Grand Total">
	                                <input type="hidden" class="js-autocomplete form-control" id="grand_input_price" name="grand_total" required>
	                            </div>
	                        </div>
	                        <div class="col-md-4 pt-3">
	                            <label for="item">Paid Amount: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" value="0" id="paid_amount" class="js-autocomplete form-control" name="paid_amount" placeholder="Paid Amount" onkeyup="paidAmount()">
	                            </div>
	                        </div>
	                        <div class="col-md-4 pt-3">
	                            <label for="item">Due: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" class="js-autocomplete form-control" id="due_price" disabled="" placeholder="Due">
	                                <input type="hidden" class="js-autocomplete form-control" id="due_input_price" name="due" required>
	                            </div>
	                        </div>
                        </div>

                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Purchase
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
</script>
<script type="text/javascript">
	function addMore(){
		let id = $("#item_id").val();
	    let url = '/admin/item/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            $(".item_name"+id).val(response.item_name);
	            $(".item_id"+id).val(response.id);
	        }
	    });
        var addDiv =  `
        <tr class="remove-tr">
    		<td class="text-center">
    			<input type="text" class="js-autocomplete form-control item_name`+id+`" disabled="">
	            <input type="hidden" class="js-autocomplete form-control item_id`+id+`" name="item_id[]" required>
    		</td>
        	<td class="text-center">
	            <input type="number" class="js-autocomplete form-control" value="0" name="purchase_price[]" min="0" required id="purchase_price`+id+`" onkeyup="purchasePrice(`+id+`)">
        	</td>
        	<td class="text-center">
	            <input type="number" class="js-autocomplete form-control" name="qty[]" min="0" value="0" required id="item_qty`+id+`" onkeyup="itemQty(`+id+`)">
        	</td>
        	<td class="text-center">
	            <input type="number" class="js-autocomplete form-control" name="discount[]" min="0" value="0" required id="discount`+id+`" onkeyup="discountAmount(`+id+`)">
        	</td>
        	<td class="text-center">
        		<input type="text" class="js-autocomplete form-control" disabled="" id="sub_total_show_purchase_price`+id+`">
	            <input type="hidden" class="js-autocomplete form-control price" name="sub_total[]" required id="sub_total_input_purchase_price`+id+`">
        	</td>
        	<td class="text-center icon-statte">
                <button type="button" class="btn btn-circle btn-alt-danger mr-5 mb-5 delete-confirm" onclick="deleteThisRow(this)">
                    <i class="fa fa-trash-o"></i>
                </button>
        	</td>
    	</tr>`;
        $('#add-div').append(addDiv);

        $('#transprotation_cost').val(0);
        $('#paid_amount').val(0);

        var total_price = $("#sub_total_price").val();
        $('#grand_total_price').val(total_price);
        $('#grand_input_price').val(total_price);
        $('#due_price').val(total_price);
        $('#due_input_price').val(total_price);
    }
    function purchasePrice(purchase_id){
        var purchase_id = purchase_id;
        var purchase_price = $('#purchase_price'+purchase_id).val();
        var item_qty = $("#item_qty"+purchase_id).val();
        var discount = $("#discount"+purchase_id).val();
        var sub_total_purchase_price = (item_qty*purchase_price)-discount;
    	$('#sub_total_show_purchase_price'+purchase_id).val(sub_total_purchase_price);
        $('#sub_total_input_purchase_price'+purchase_id).val(sub_total_purchase_price);

        row_total_price();
    }

    function itemQty(item_id){
        var item_id = item_id;
        var item_qty = $('#item_qty'+item_id).val();
        var purchasePrice = $("#purchase_price"+item_id).val();
        var discount = $("#discount"+item_id).val();
        var sub_total_purchase_price = (item_qty*purchasePrice)-discount;
    	$('#sub_total_show_purchase_price'+item_id).val(sub_total_purchase_price);
        $('#sub_total_input_purchase_price'+item_id).val(sub_total_purchase_price);

        row_total_price();
    }

    function discountAmount(discount_id){
    	var discount_id = discount_id;
    	console.log(discount_id);
        var item_qty = $('#item_qty'+discount_id).val();
        var purchasePrice = $("#purchase_price"+discount_id).val();
        var discount = $("#discount"+discount_id).val();
        var sub_total_purchase_price = (item_qty*purchasePrice)-discount;
    	$('#sub_total_show_purchase_price'+discount_id).val(sub_total_purchase_price);
        $('#sub_total_input_purchase_price'+discount_id).val(sub_total_purchase_price);

        row_total_price();
    }
    
    function row_total_price(){
        var total = 0;
        $('.price').each(function(){
            total += parseInt($(this).val());
            $('#sub_total_price').val(total);
            $('#sub_total_input').val(total);
            $('#grand_total_price').val(total);
            $('#grand_input_price').val(total);
            $('#due_price').val(total);
            $('#due_input_price').val(total);
        });
        return total;
    }


    function transprotationPrice(){

    	let transprotation_cost = document.getElementById('transprotation_cost');
        if(transprotation_cost < 0 || transprotation_cost == '' || transprotation_cost == ' '){
            $('#transprotation_cost').val(0);
            transprotation_cost = parseInt($('#transprotation_cost').val());
        }else{
            transprotation_cost = parseInt($('#transprotation_cost').val());
        }
        let total_price = row_total_price();

        let discount = document.getElementById('discount');
        if (discount < 0 || discount == '' || discount == ' '){
        	var transprotationPrice = total_price + transprotation_cost - discount;
	        $('#grand_total_price').val(transprotationPrice);
	        $('#grand_input_price').val(transprotationPrice);

	        $('#due_price').val(transprotationPrice); 
	        $('#due_input_price').val(transprotationPrice);
        }else{
        	var transprotationPrice = total_price + transprotation_cost;
	        $('#grand_total_price').val(transprotationPrice);
	        $('#grand_input_price').val(transprotationPrice);

	        $('#due_price').val(transprotationPrice); 
	        $('#due_input_price').val(transprotationPrice);
        }

        return transprotationPrice;
    }

    function paidAmount(){
        var paid_amount = $('#paid_amount').val();
        var grand_total_price = $('#grand_total_price').val();
        //console.log(paid_amount);
        if(paid_amount < 0 || paid_amount == '' || paid_amount == ' '){
            $('#paid_amount').val(0);
            paid_amount = $('#paid_amount').val();
            $('#paid_amount').val(paid_amount);
        }else{
            paid_amount = $('#paid_amount').val();
            $('#paid_amount').val(paid_amount);
        }
        var due = grand_total_price - paid_amount;
        $('#due_price').val(due); 
        $('#due_input_price').val(due);

    }

    function deleteThisRow(em){
        $(em).closest('.remove-tr').remove();
        var total_bal = row_total_price();
        if(total_bal == 0){
        	$('#sub_total_price').val(0);
            $('#sub_total_input').val(0);
            $('#grand_total_price').val(0);
            $('#grand_input_price').val(0);
            $('#due_price').val(0);
            $('#due_input_price').val(0);
            $('#transprotation_cost').val(0);
        	$('#paid_amount').val(0);
        }else{
        	$('#transprotation_cost').val(0);
        	$('#paid_amount').val(0);
        }        
    }
</script>
@endsection
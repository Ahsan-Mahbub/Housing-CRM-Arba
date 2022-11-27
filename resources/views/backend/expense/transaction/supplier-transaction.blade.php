@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-6 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Add Transaction</h3>
                </div>
                <div class="block-content">
                    <form action="" method="get">
	                    @csrf
                        <div class="form-group row justify">
                            <div class="col-md-12 pt-2">
                            	<label for="status">Supplier Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="supplier_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($suppliers as $supplier)
	                                	<option value="{{$supplier->id}}" {{$supplier->id == $supplier_id ? 'selected' : ''}}>{{$supplier->supplier_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                        </div>

                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Find Another Supllier Stock
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="container">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title text-white"><b>Due Collection</b></h3>
        </div>
        <form action="{{route('transaction.store')}}" method="post">
            @csrf
            <input type="hidden" name="supplier_id" value="{{$supplier_id}}">
            <?php
                $today_date = date("jS F Y");
            ?>
            <input type="hidden" name="date" value="{{$today_date}}">
            <?php
                $total_stocks = count($stocks);
            ?>
            @if($total_stocks > 0)
            <div class="block-content block-content-full">
                <div class="table table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>S/L &nbsp;</th>
                                <th>Stock Date &nbsp;</th>
                                <th>Project &nbsp;</th>
                                <th>Purchase Code &nbsp;</th>
                                <th>Grand Total &nbsp;</th>
                                <th>Paid &nbsp;</th>
                                <th>Due &nbsp;</th>
                                <th>Now Pay* &nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl = 1; @endphp
                            @foreach($stocks as $stock)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$stock->date}}</td>
                                <td>{{$stock->project->project_name}}</td>
                                <td>{{$stock->purchase_code}}</td>
                                <td>{{$stock->grand_total}}</td>
                                <td>
                                    {{$stock->paid_amount}}
                                    <input type="hidden" name="paid_amount[]" value="{{$stock->paid_amount}}">
                                </td>
                                <td>
                                    {{$stock->due}}
                                    <input type="hidden" class="due_price" name="due_amount[]" value="{{$stock->due}}">
                                </td>
                                <td>
                                    <input type="hidden" name="stock_id[]" value="{{$stock->id}}">
                                    <input class="form-control price" type="number" max="{{$stock->due}}" min="0" name="amount[]" placeholder="Pay Amount" value="{{$stock->due}}" required onkeyup="row_total_price()">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <table class="table table-bordered table-striped table-sm">
                                <tr>
                                    <td class="text-center">Payment Method *</td>
                                    <td>
                                        <select class="form-control" name="method_id" id="method_id" required="" onchange="getAccount()">
                                            <option value="">Please select</option>
                                            @foreach($methods as $method)
                                            <option value="{{$method->id}}">{{$method->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Account *</td>
                                    <td>
                                        <select class="form-control" id="account_id" name="account_id" required="">
                                            <option value="">Please select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Now Pay Amount</td>
                                    <td>
                                        <input class="form-control" disabled="" value="0" id="dis_total_amount">
                                        <input class="form-control" type="hidden" name="total_amount" value="0" id="total_amount">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-right">
                            <button Type="submit" class="btn btn-alt-primary">
                                Pay Amount
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="p-4 text-center">
                <strong class="text-danger font-w700"> Stock Item Not Found !!</strong>
            </div>
            @endif
        </form>
    </div>
</div>
<div class="container">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title text-white"><b>Supplier Transaction List</b></h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>S/L &nbsp;</th>
                            <th>Date &nbsp;</th>
                            <th>Stock Purchase Code &nbsp;</th>
                            <th>Method Name &nbsp;</th>
                            <th>Account Name &nbsp;</th>                            
                            <th>Amount &nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1; @endphp
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$transaction->date}}</td>
                            <td>{{$transaction->stock ? $transaction->stock->purchase_code : 'N/A'}}</td>
                            <td>{{$transaction->method->name}}</td>
                            <td>{{$transaction->account ? $transaction->account->account_name : 'N/A'}}</td>
                            <td>{{$transaction->amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    $( document ).ready(function() {
        var total = 0;
        $('.due_price').each(function(){
            total += parseInt($(this).val());
            if(total > 0){
                $('#total_amount').val(total);
                $('#dis_total_amount').val(total)
            }else{
                $('#total_amount').val(0);
                $('#dis_total_amount').val(0)
            }
        });
    });

    function row_total_price(){
        var total = 0;
        $('.price').each(function(){
            total += parseInt($(this).val());
            if(total > 0){
                $('#total_amount').val(total);
                $('#dis_total_amount').val(total)
            }else{
                $('#total_amount').val(0);
                $('#dis_total_amount').val(0)
            }
        });
    }
</script>
@endsection
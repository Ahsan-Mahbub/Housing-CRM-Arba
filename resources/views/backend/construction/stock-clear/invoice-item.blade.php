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
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Stock Clear</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('stock.clear.invoice')}}" method="get">
                        <div class="form-group row">
                            <div class="col-md-6 pt-2">
                            	<label for="status">Project Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" id="project_id" name="project_id" required="" onclick="getPurcase()">
	                                	<option value="">Please select</option>
	                                	@foreach($projects as $project)
	                                	<option value="{{$project->id}}" {{$project->id == $project_id ? 'selected' : ''}}>{{$project->project_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
                            	<label for="status">Invoice or Purchase Code: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="purchase_code" id="purchase_code" required="">
	                                	<option value="">Please select</option>
	                                	@if($stock)
	                                	<option value="{{$stock->id}}" selected>{{$stock->purchase_code}}</option>
	                                	@endif
	                                </select>
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Find Item
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center header-div">
                    	<label class="text-center font-w600 m-1" style="text-transform: uppercase;">Items Stock Clear</label>
                    </div>
                    <form action="{{route('stock.clear.store')}}" method="post">
                    	@csrf
                        <div class="form-group row justify-content-center">
                            <div class="block-content block-content-full">
                            	<div class="table table-responsive">
	                            	<table class="table table-bordered">
						                <thead>
						                    <tr>
						                        <th class="text-center">Item Name &nbsp;</th>
						                        <th class="text-center">Total Stock &nbsp;</th>
						                        <th class="text-center">Used Stock &nbsp;</th>
						                        <th class="text-center">Available Stock &nbsp;</th>
						                        <th class="text-center">Clear Stock &nbsp;</th>
						                    </tr>
						                </thead>
						                <tbody>
						                	@foreach($stock_item as $item)
						                	<tr>
						                		<td class="text-center">{{$item->item ? $item->item->item_name : ''}}</td>
							                	<td class="text-center">{{$item->qty}}</td>
							                	<td class="text-center">
							                		<?php
							                			$clear_stock = App\Models\StockClear::where('stock_id', $item->stock_id)->where('item_id',$item->item_id)->where('stock_item_id', $item->id)->sum('clear_qty');

							                		?>
							                		{{$clear_stock}}
							                	</td>
							                	<td class="text-center">
							                		<?php
							                			$availble_stock = $item->qty - $clear_stock;
							                		?>
							                		{{$availble_stock}}
							                	</td>
							                	<td class="text-center">
							                		<input type="hidden" name="stock_item_id[]" value="{{$item->id}}">
							                		<input type="hidden" name="stock_id[]" value="{{$item->stock_id}}">
							                		<input type="hidden" name="item_id[]" value="{{$item->item_id}}">
							                		<input type="hidden" value="{{$item->qty}}" name="qty[]">
							                		<input type="hidden" value="{{$item->sub_total}}" name="sub_total[]">
							                		<input class="form-control" type="number" name="clear_qty[]" min="0" max="{{$availble_stock}}" value="0">
							                	</td>
						                	</tr>
						                	@endforeach
						                </tbody>
						            </table>
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Clear Stock
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
	function getPurcase(){
	    let id = $("#project_id").val();
	    let url = '/admin/purchase-code/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            let html = '';
	            //console.log(response)
	            html+='<option value="">Please select</option>'
	            response.forEach(element => {
	                html+='<option value='+element.id+'>'+element.purchase_code+'</option>'
	            });
	            $("#purchase_code").html(html);

	        }
	    });
	}
</script>
@endsection
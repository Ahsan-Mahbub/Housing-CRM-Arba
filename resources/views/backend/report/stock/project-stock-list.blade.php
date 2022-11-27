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
	<div class="block-header block-header-default">
        <h3 class="block-title text-white"><b>Project Wise Stock Report</b></h3>
        <button type="button" class="btn-block-option" onclick="printDiv('printableArea')">
            <i class="si si-printer"></i> Print List
        </button>
    </div>
    <br>
	<div class="block" id="printableArea">
		@foreach($stocks as $stock)
		<div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Prchase Code: {{$stock->purchase_code}}</b></h3>
	    </div>
	    <div class="block-content block-content-full">
		    <div class="row justify">
		    	<div class="col-md-3">
		    		<p><strong>Supplier Name : </strong>{{$stock->supplier ? $stock->supplier->supplier_name : 'N/A'}}</p>
		    		<p><strong>Project Name : </strong>{{$stock->project ? $stock->project->project_name : 'N/A'}}</p>
		        </div>
	          	<div class="col-md-3">
	          		<p><strong>Date : </strong>{{$stock->date}}</p>
	          		<p><strong>Purchase Code : </strong>{{$stock->purchase_code}}</p>
	      		</div>
	      		<div class="col-md-3">
	      			<p><strong>Total Price : </strong>{{$stock->total_price}}</p>
	      			<p><strong>Transection + Other Cost : </strong>{{$stock->transprotation_cost}}</p>
	      		</div>
	      		<div class="col-md-3">
	      			<p class="font-w700 text-success"><strong>Paid Amount : </strong>{{$stock->paid_amount}}</p>
	      			<p class="font-w700 text-danger"><strong>Due Amount : </strong>{{$stock->due}}</p>
	      		</div>
	        </div>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                        <th class="text-center">Item Name &nbsp;</th>
	                        <th class="text-center">Item Stock &nbsp;</th>
	                        <th class="text-center">Item Amount &nbsp;</th>
	                        <th class="text-center">Clear / Used Item &nbsp;</th>
	                        <th class="text-center">Used Item Amount &nbsp;</th>
	                        <th class="text-center">Available Item &nbsp;</th>
	                        <th class="text-center">Available Item Amount &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php
	                		$stock_item = App\Models\StockItem::where('stock_id', $stock->id)->get();
	                	?>
	                	@foreach($stock_item as $item)
	                	<tr>
	                		<td class="text-center">{{$item->item ? $item->item->item_name : ''}}</td>
		                	<td class="text-center">{{$item->qty}}</td>
		                	<td class="text-center">{{$item->sub_total}}</td>
		                	<td class="text-center">
		                		<?php
		                			$clear_stock = App\Models\StockClear::where('stock_id', $item->stock_id)->where('item_id',$item->item_id)->where('stock_item_id', $item->id)->sum('clear_qty');

		                		?>
		                		{{$clear_stock}}
		                	</td>
		                	<td class="text-center">
		                		<?php
		                			$clear_amount = App\Models\StockClear::where('stock_id', $item->stock_id)->where('item_id',$item->item_id)->where('stock_item_id', $item->id)->sum('clear_qty_price');

		                		?>
		                		{{$clear_amount}}
		                	</td>
		                	<td class="text-center">
		                		<?php
		                			$availble_stock = $item->qty - $clear_stock;
		                		?>
		                		{{$availble_stock}}
		                	</td>
		                	<td class="text-center">
		                		<?php
		                			$availble_item = $item->sub_total - $clear_amount;
		                		?>
		                		{{$availble_item}}
		                	</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	    @endforeach
	</div>
</div>
@endsection
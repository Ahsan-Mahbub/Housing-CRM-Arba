@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Unit Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Unit
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Unit Name &nbsp;</th>
	                        <th class="text-center">Unit Symbol &nbsp;</th>
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($units as $unit)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$unit->unit_name}}</td>
		                	<td class="text-center">{{$unit->symbol}}</td>
		                	<td class="text-center">
		                		@if($unit->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('unit.delete',$unit->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('unit.status',$unit->id)}}" class="btn btn-circle mr-5 mb-5 {{$unit->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$unit->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
			                		<a data-toggle="modal" data-target="#modal-edit" id="editunit" data="{{$unit->id}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
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

<!-- unit add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Unit</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('unit.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                        <div class="form-group row">
	                            <label class="col-12" for="unit">Unit Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" name="unit_name" required placeholder="Unit Name..">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-12" for="unit">Unit Symbol: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" name="symbol" required placeholder="Unit Symbol..">
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
<!-- end unit add modal -->

<!-- edit unit edit modal -->
<div class="modal show" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Edit Unit</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('unit.update')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<input type="hidden" name="id" id="unit_id">
	                        <div class="form-group row">
	                            <label class="col-12" for="unit">Unit Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" id="unit_name" class="js-autocomplete form-control" name="unit_name" required placeholder="Unit Name..">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-12" for="unit">Unit Symbol: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" id="symbol" class="js-autocomplete form-control" name="symbol" required placeholder="Unit Symbol..">
	                            </div>
	                        </div>
	                        <div class="form-group text-right">
	                            <button type="submit" class="btn btn-square btn-primary min-width-125 mb-10 mt-20">Update</button>
	                        </div>
	                    </form>
				    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end unit edit modal -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).on("click", "#editunit", function () {
        let id = $(this).attr("data");
        console.log(id);
        $.ajax({
            url: "/admin/unit/edit/"+id,
            type: "get",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#unit_id").val(response.id);
                $("#unit_name").val(response.unit_name);
                $("#symbol").val(response.symbol);
            }
        })
    })
</script>
@endsection
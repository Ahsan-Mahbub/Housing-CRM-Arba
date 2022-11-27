@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Supplier Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Supplier
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Supplier Name &nbsp;</th>
	                        <th class="text-center">Phone &nbsp;</th>
	                        <th class="text-center">Email &nbsp;</th>
	                        <th class="text-center">Address &nbsp;</th>
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($suppliers as $supplier)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$supplier->supplier_name}}</td>
		                	<td class="text-center">{{$supplier->phone}}</td>
		                	<td class="text-center">{{$supplier->email}}</td>
		                	<td class="text-center">{{$supplier->address}}</td>
		                	<td class="text-center">
		                		@if($supplier->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('supplier.delete',$supplier->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('supplier.status',$supplier->id)}}" class="btn btn-circle mr-5 mb-5 {{$supplier->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$supplier->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
			                		<a data-toggle="modal" data-target="#modal-edit" id="editsupplier" data="{{$supplier->id}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
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

<!-- supplier add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Supplier</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('supplier.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                        <div class="form-group row">
	                            <label class="col-12" for="supplier">Supplier Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" name="supplier_name" required placeholder="Supplier Name..">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-md-6">
	                            	<label for="supplier">Supplier Number: <span class="text-danger">*</span></label>
		                            <div>
		                                <input type="text" class="js-autocomplete form-control" name="phone" required placeholder="Supplier Number..">
		                            </div>
	                            </div>
	                            <div class="col-md-6">
	                            	<label for="supplier">Supplier Email: </label>
		                            <div>
		                                <input type="email" class="js-autocomplete form-control" name="email" required placeholder="Supplier Email..">
		                            </div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-12" for="supplier">Address: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <textarea class="form-control" name="address" placeholder="Address.."></textarea>
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
<!-- end supplier add modal -->

<!-- edit supplier edit modal -->
<div class="modal show" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Edit Supplier</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('supplier.update')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<input type="hidden" name="id" id="supplier_id">
	                        <div class="form-group row">
	                            <label class="col-12" for="supplier">Supplier Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" id="supplier_name" class="js-autocomplete form-control" name="supplier_name" required placeholder="Supplier Name..">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-md-6">
	                            	<label for="supplier">Supplier Number: <span class="text-danger">*</span></label>
		                            <div>
		                                <input type="text" id="phone" class="js-autocomplete form-control" name="phone" required placeholder="Supplier Number..">
		                            </div>
	                            </div>
	                            <div class="col-md-6">
	                            	<label for="supplier">Supplier Email: </label>
		                            <div>
		                                <input type="email" id="email" class="js-autocomplete form-control" name="email" required placeholder="Supplier Email..">
		                            </div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-12" for="supplier">Address: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <textarea class="form-control" id="address" name="address" placeholder="Address.."></textarea>
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
<!-- end supplier edit modal -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).on("click", "#editsupplier", function () {
        let id = $(this).attr("data");
        console.log(id);
        $.ajax({
            url: "/admin/supplier/edit/"+id,
            type: "get",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#supplier_id").val(response.id);
                $("#supplier_name").val(response.supplier_name);
                $("#phone").val(response.phone);
                $("#email").val(response.email);
                $("#address").val(response.address);
            }
        })
    })
</script>
@endsection
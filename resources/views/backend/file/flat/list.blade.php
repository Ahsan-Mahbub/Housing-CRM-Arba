@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Flat Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Flat
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Project Name &nbsp;</th>
	                        <th class="text-center">Flat Name &nbsp;</th>
	                        <th class="text-center">Size &nbsp;</th>
	                        <th class="text-center">Facing &nbsp;</th>
	                        <th class="text-center">Confirmation &nbsp;</th>
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($flats as $flat)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$flat->project ? $flat->project->project_name : 'N/a'}}</td>
		                	<td class="text-center">{{$flat->flat_name}}</td>
		                	<td class="text-center">{{$flat->size}}</td>
		                	<td class="text-center">{{$flat->facing}}</td>
		                	<td class="text-center">
		                		@if($flat->confirmattion == 1)
		                			<span class="badge badge-success">Sold</span>
		                		@else
		                			<span class="badge badge-danger">Unsold</span>
		                		@endif
		                	</td>
		                	<td class="text-center">
		                		@if($flat->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('flat.delete',$flat->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('flat.status',$flat->id)}}" class="btn btn-circle mr-5 mb-5 {{$flat->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$flat->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
			                		<a data-toggle="modal" data-target="#modal-edit" id="editflat" data="{{$flat->id}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
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

<!-- flat add modal -->
<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Add Flat</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('flat.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                        <div class="form-group row">
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Project Name:</label>
		                            <div class="col-lg-12">
		                                <select class="form-control" name="project_id" required="">
		                                	<option value="">Please select</option>
		                                	@foreach($projects as $project)
		                                	<option value="{{$project->id}}">{{$project->project_name}}</option>
		                                	@endforeach
		                                </select>
		                            </div>
	                            </div>
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Flat Name:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="flat_name" required placeholder="Flat Name..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Size:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="size" placeholder="Size..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Bedroom:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="bedroom" placeholder="Bedroom..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Bathroom:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="bathroom" placeholder="Bathroom..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Unit:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="unit" placeholder="Unit..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Drawing:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="drawing" placeholder="Drawing..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Dining:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="dining" placeholder="Dining..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Balcony:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="balcony" placeholder="Balcony..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Which Floor:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="floor" placeholder="Which Floor..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Parking:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="parking" placeholder="Parking..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Basement:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="basement" placeholder="Basement..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Facing:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" name="facing" placeholder="Facing..">
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
<!-- end flat add modal -->

<!-- edit flat edit modal -->
<div class="modal show" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-white">Edit Flat</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('flat.update')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                    	<input type="hidden" name="id" id="flat_id">
	                        <div class="form-group row">
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Flat Name:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="flat_name" name="flat_name" required placeholder="Flat Name..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Size:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="size" name="size" placeholder="Size..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Bedroom:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="bedroom" name="bedroom" placeholder="Bedroom..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Bathroom:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="bathroom" name="bathroom" placeholder="Bathroom..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Unit:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="unit" name="unit" placeholder="Unit..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Drawing:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="drawing" name="drawing" placeholder="Drawing..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Dining:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="dining" name="dining" placeholder="Dining..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Balcony:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="balcony" name="balcony" placeholder="Balcony..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Which Floor:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="floor" name="floor" placeholder="Which Floor..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Parking:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="parking" name="parking" placeholder="Parking..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Basement:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="basement" name="basement" placeholder="Basement..">
		                            </div>
	                            </div>
	                            <div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Facing:</label>
		                            <div class="col-lg-12">
		                                <input type="text" class="js-autocomplete form-control" id="facing" name="facing" placeholder="Facing..">
		                            </div>
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
<!-- end flat edit modal -->
@endsection
@section('script')
<script type="text/javascript">
	$(document).on("click", "#editflat", function () {
        let id = $(this).attr("data");
        console.log(id);
        $.ajax({
            url: "/admin/flat/edit/"+id,
            type: "get",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#flat_id").val(response.id);
                $("#flat_name").val(response.flat_name);
                $("#size").val(response.size ? response.size : '');
                $("#bedroom").val(response.bedroom ? response.bedroom : '');
                $("#bathroom").val(response.bathroom ? response.bathroom : '');
                $("#drawing").val(response.drawing ? response.drawing : '');
                $("#dining").val(response.dining ? response.dining : '');
                $("#balcony").val(response.balcony ? response.balcony : '');
                $("#floor").val(response.floor ? response.floor : '');
                $("#parking").val(response.parking ? response.parking : '');
                $("#basement").val(response.basement ? response.basement : '');
                $("#facing").val(response.facing ? response.facing : '');
                $("#unit").val(response.unit ? response.unit : '');
            }
        })
    })
</script>
@endsection
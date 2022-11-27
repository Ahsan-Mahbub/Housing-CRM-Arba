@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Customer Flat Assign Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Flat Assign
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">Customer Name &nbsp;</th>
	                        <th class="text-center">Project Name &nbsp;</th>
	                        <th class="text-center">Flat Name &nbsp;</th>
	                        <th class="text-center">Current Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($assign_flats as $assign)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
	                		<td class="text-center">{{$assign->customer ? $assign->customer->customer_name : 'N/A'}}</td>
		                	<td class="text-center">{{$assign->project ? $assign->project->project_name : 'N/A'}}</td>
		                	<td class="text-center">{{$assign->flat ? $assign->flat->flat_name : 'N/A'}}</td>
		                	<td class="text-center font-w700 text-success">
		                		{{$assign->type ? $assign->type->type_name : 'N/A'}}
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('flat-assign.delete',$assign->id)}}" method="post" accept-charset="utf-8">
	                                @csrf
	                                @method('delete')
	                                <a href="{{route('flat-assign.show',$assign->id)}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
		                                <i class="fa fa-eye"></i>
		                            </a>
	                                @if($assign->type_id != 3)
	                                <button type="submit" class="btn btn-circle btn-alt-danger mr-5 mb-5 delete-confirm">
		                                <i class="fa fa-trash-o"></i>
		                            </button>
		                            @endif
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
                    <h3 class="block-title text-white">Add Customer Flat Assign</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="modal-body">
                    	<form action="{{route('flat-assign.store')}}" method="post" enctype="multipart/form-data">
	                    	@csrf
	                        <div class="form-group row">
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Project Name:</label>
		                            <div class="col-lg-12">
		                                <select class="form-control" id="project_id" name="project_id" required="" onchange="getFlot()">
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
		                                <select class="form-control" id="flat_id" name="flat_id" required>
		                                	<option value="">Please select</option>
		                                </select>
		                            </div>
	                            </div>
	                        	<div class="col-md-6 pt-2">
	                            	<label class="col-12" for="status">Customer Name:</label>
		                            <div class="col-lg-12">
		                                <select class="form-control" id="project_id" name="customer_id" required="">
		                                	<option value="">Please select</option>
		                                	@foreach($customers as $customer)
		                                	<option value="{{$customer->id}}">{{$customer->customer_name}}</option>
		                                	@endforeach
		                                </select>
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
@endsection
@section('script')
<script type="text/javascript">
	function getFlot(){
	    let id = $("#project_id").val();
	    let url = '/admin/project/'+id;
	    $.ajax({
	        type: "get",
	        url: url,
	        dataType: "json",
	        success: function (response) {
	            let html = '';
	            //console.log(response)
	            html+='<option value="">Please select</option>'
	            response.forEach(element => {
	                html+='<option value='+element.id+'>'+element.flat_name+'</option>'
	            });
	            $("#flat_id").html(html);

	        }
	    });
	}
</script>
@endsection
@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="block">
	    <div class="block-header block-header-default">
	        <h3 class="block-title text-white"><b>Fund User Table</b></h3>
	        <a data-toggle="modal" data-target="#modal-large" class="btn btn-sm btn-alt-info">
	            <i class="fa fa-plus mr-5"></i>Add Fund User
	        </a>
	    </div>
	    <div class="block-content block-content-full">
	    	<div class="table table-responsive">
	            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	                <thead>
	                    <tr>
	                        <th class="text-center">S/L &nbsp;</th>
	                        <th class="text-center">User Name &nbsp;</th>
	                        <th class="text-center">Email &nbsp;</th>
	                        <th class="text-center">Phome &nbsp;</th>
	                        <th class="text-center">Address &nbsp;</th>
	                        <th class="text-center">Status &nbsp;</th>
	                        <th class="text-center">Action &nbsp;</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@php $sl = 1; @endphp
                    	@foreach($users as $user)
	                	<tr>
	                		<td class="text-center">{{$sl++}}</td>
		                	<td class="text-center">{{$user->name}}</td>
		                	<td class="text-center">{{$user->email}}</td>
		                	<td class="text-center">{{$user->phone}}</td>
		                	<td class="text-center">{{$user->address}}</td>
		                	<td class="text-center">
		                		@if($user->status == 1)
		                			<span class="badge badge-success">Active</span>
		                		@else
		                			<span class="badge badge-danger">Inactive</span>
		                		@endif
		                	</td>
		                	<td class="text-center icon-statte">
	                            <form action="{{route('fund-user.delete',$user->id)}}" method="post" accept-charset="utf-8">
	                            	<a href="{{route('fund-user.status',$user->id)}}" class="btn btn-circle mr-5 mb-5 {{$user->status == 1 ? 'btn-alt-success' :'btn-alt-danger'}}">
		                                <i class="fa fa-refresh {{$user->status == 1 ? 'text-success' :'text-danger'}}"></i>
		                            </a>
		                            <a href="{{route('fund-user.show',$user->id)}}" class="btn btn-circle mr-5 mb-5 btn-alt-info">
		                                <i class="fa fa-eye"></i>
		                            </a>
			                		<a data-toggle="modal" data-target="#modal-edit" id="edituser" data="{{$user->id}}" class="btn btn-circle btn-alt-info mr-5 mb-5">
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

	<!-- method add modal -->
	<div class="modal show" id="modal-large" tabindex="-1" role="dialog" aria-labelledby="modal-large">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="block block-themed block-transparent mb-0">
	                <div class="block-header bg-primary-dark">
	                    <h3 class="block-title text-white">Add Fund User</h3>
	                    <div class="block-options">
	                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
	                            <i class="si si-close"></i>
	                        </button>
	                    </div>
	                </div>
	                <div class="block-content">
	                    <div class="modal-body">
	                    	<form action="{{route('fund-user.store')}}" method="post" enctype="multipart/form-data">
		                    	@csrf
		                        <div class="form-group row">
		                            <div class="col-md-4 pt-2">
		                            	<label for="method">Fund User Name: <span class="text-danger">*</span></label>
			                            <input type="text" class="js-autocomplete form-control" name="name" required placeholder="Fund User Name..">
		                            </div>
		                             <div class="col-md-4 pt-2">
		                            	<label for="method">User Email: </label>
			                            <input type="email" class="js-autocomplete form-control" name="email" placeholder="User Email..">
		                            </div>
		                            <div class="col-md-4 pt-2">
		                            	<label for="method">User Phone: <span class="text-danger">*</span></label>
			                            <input type="text" class="js-autocomplete form-control" name="phone" required placeholder="User Phone..">
		                            </div>
		                            <div class="col-md-12 pt-2">
		                            	<label for="method">User Address: </label>
			                            <textarea rows="5" class="js-autocomplete form-control" name="address" required placeholder="User Address.."></textarea>
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
	<!-- end method add modal -->

	<!-- edit method edit modal -->
	<div class="modal show" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-large">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="block block-themed block-transparent mb-0">
	                <div class="block-header bg-primary-dark">
	                    <h3 class="block-title text-white">Edit Fund User</h3>
	                    <div class="block-options">
	                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
	                            <i class="si si-close"></i>
	                        </button>
	                    </div>
	                </div>
	                <div class="block-content">
	                    <div class="modal-body">
	                    	<form action="{{route('fund-user.update')}}" method="post" enctype="multipart/form-data">
		                    	@csrf
		                    	<input type="hidden" name="id" id="method_id">
		                        <div class="form-group row">
		                            <div class="col-md-4 pt-2">
		                            	<label for="method">Fund User Name: <span class="text-danger">*</span></label>
			                            <input type="text" class="js-autocomplete form-control" name="name" id="name" required placeholder="Fund User Name..">
		                            </div>
		                            <div class="col-md-4 pt-2">
		                            	<label for="method">User Email: </label>
			                            <input type="email" class="js-autocomplete form-control" name="email" id="email" placeholder="User Email..">
		                            </div>
		                            <div class="col-md-4 pt-2">
		                            	<label for="method">User Phone: <span class="text-danger">*</span></label>
			                            <input type="text" class="js-autocomplete form-control" name="phone" id="phone" required placeholder="User Phone..">
		                            </div>
		                            <div class="col-md-12 pt-2">
		                            	<label for="method">User Address: </label>
			                            <textarea rows="5" class="js-autocomplete form-control" name="address" id="address" required placeholder="User Address.."></textarea>
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
	<!-- end method edit modal -->
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).on("click", "#edituser", function () {
        let id = $(this).attr("data");
        console.log(id);
        $.ajax({
            url: "/admin/fund-user/edit/"+id,
            type: "get",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $("#method_id").val(response.id);
                $("#name").val(response.name);
                $("#email").val(response.email);
                $("#phone").val(response.phone);
                $("#address").val(response.address);
            }
        })
    })
</script>
@endsection
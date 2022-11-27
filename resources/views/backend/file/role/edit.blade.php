@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Role Update</h3>
                    <div class="block-options">
                        <a href="{{route('role.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Role List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('role.update',$role->id)}}" method="post" enctype="multipart/form-data">
	                    @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                            	<label class="col-12" for="role">Role Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" id="role_name" class="js-autocomplete form-control" value="{{$role->role_name}}" name="role_name" required placeholder="Role Name..">
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
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
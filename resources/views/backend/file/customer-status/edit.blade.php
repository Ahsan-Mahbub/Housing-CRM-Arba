@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Customer Status Update</h3>
                    <div class="block-options">
                        <a href="{{route('customer-status.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Customer Status List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('customer-status.update',$customer_status->id)}}" method="post" enctype="multipart/form-data">
	                    @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                            	<label class="col-12" for="status">Customer Type Name: <span class="text-danger">*</span></label>
	                            <div class="col-lg-12">
	                                <input type="text" class="js-autocomplete form-control" name="type_name" value="{{$customer_status->type_name}}" required placeholder="Customer Type Name..">
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
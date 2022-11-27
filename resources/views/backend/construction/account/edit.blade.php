@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Account Update</h3>
                    <div class="block-options">
                        <a href="{{route('account.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Account List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('account.update',$account->id)}}" method="post" enctype="multipart/form-data">
	                    @csrf
                        <div class="form-group row">
                            <div class="col-md-6 pb-2">
                            	<label for="account">Select Payment Method: <span class="text-danger">*</span></label>
	                            <div>
	                            	<select class="form-control" name="method_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($methods as $method)
	                                	<option value="{{$method->id}}" {{$method->id == $account->method_id ? 'selected' : ''}}>{{$method->name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-6 pb-2">
                            	<label for="account">Account Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="text" class="js-autocomplete form-control" name="account_name" required placeholder="Account Name.." value="{{$account->account_name}}">
	                            </div>
                            </div>
                            <div class="col-md-6 pb-2">
                            	<label for="account">Account Number: </label>
	                            <div>
	                                <input type="text" class="js-autocomplete form-control" name="number" placeholder="Account Number.." value="{{$account->number}}">
	                            </div>
                            </div>
                            <div class="col-md-6 pb-2">
                            	<label for="account">Account Branch: </label>
	                            <div>
	                                <input type="text" class="js-autocomplete form-control" name="branch" placeholder="Account Branch.." value="{{$account->branch}}">
	                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Update
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
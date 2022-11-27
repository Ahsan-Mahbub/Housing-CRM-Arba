@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-10 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Item Update</h3>
                    <div class="block-options">
                        <a href="{{route('item.list')}}" class="btn btn-sm btn-alt-primary">
				            <i class="fa fa-list mr-5"></i>Item List
				        </a>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('item.update',$item->id)}}" method="post" enctype="multipart/form-data">
	                    @csrf
                        <div class="form-group row">
                            <div class="col-md-6 pt-2">
                            	<label for="status">Unit Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="unit_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($units as $unit)
	                                	<option value="{{$unit->id}}" {{$item->unit_id == $unit->id ? 'selected' : ''}}>{{$unit->unit_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                            <div class="col-md-6 pt-2">
	                            <label for="item">Item Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="text" class="js-autocomplete form-control" name="item_name" value="{{$item->item_name}}" required placeholder="Item Name..">
	                            </div>
	                        </div>
	                        <!-- <div class="col-md-4 pt-2">
	                            <label for="item">Price: <span class="text-danger">*</span></label>
	                            <div>
	                                <input type="number" min="1" class="js-autocomplete form-control" value="{{$item->price}}" name="price" required placeholder="Price..">
	                            </div>
	                        </div> -->
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
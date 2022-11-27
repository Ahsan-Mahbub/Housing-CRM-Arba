@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify">
		<div class="col-xl-6 single-filed">
			<div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Add Transaction</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('transaction.supplier')}}" method="get">
                        <div class="form-group row justify">
                            <div class="col-md-12 pt-2">
                            	<label for="status">Supplier Name: <span class="text-danger">*</span></label>
	                            <div>
	                                <select class="form-control" name="supplier_id" required="">
	                                	<option value="">Please select</option>
	                                	@foreach($suppliers as $supplier)
	                                	<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
                            </div>
                        </div>

                        <div class="form-group row pt-3">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Find Supllier Stock
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
@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-xl-6 single-filed">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title text-white">Office Expense Report</h3>
                </div>
                <div class="block-content">
                    <form action="{{route('report.expense')}}" method="get">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-12">From <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="date" class="js-autocomplete form-control" name="from_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="col-12">To <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="date" class="js-autocomplete form-control" name="to_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button Type="submit" class="btn btn-alt-primary">
                                    Find
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
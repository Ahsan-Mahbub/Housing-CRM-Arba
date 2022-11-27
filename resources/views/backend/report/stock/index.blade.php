@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
        <?php
            $currentURL = URL::current();
            $project_stock_url = url('/admin/report/project-stock-report');
            $supplier_stock_url = url('/admin/report/supplier-stock-report');
        ?>
        <?php
        if ($currentURL == $project_stock_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Project Wise Stock Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.project.stock')}}" method="get">
                        	<div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Projects: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="project_id" required>
                                            <option value="">Please select</option>
                                            @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                                            @endforeach
                                        </select>
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
            <?php
        }
        ?>

        <?php
        if ($currentURL == $supplier_stock_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Supplier Wise Stock Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.supplier.stock')}}" method="get">
                        	<div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Supplier: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="supplier_id" required>
                                            <option value="">Please select</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                            @endforeach
                                        </select>
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
            <?php
        }
        ?>
	</div>
</div>
@endsection
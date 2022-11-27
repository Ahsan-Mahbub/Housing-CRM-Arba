@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
        <?php
            $currentURL = URL::current();
            $customer_url = url('/admin/report/customer-report');
            $sold_url = url('/admin/report/sold-report');
            $status_url = url('/admin/report/status-report');
            $user_url = url('/admin/report/user-report');
        ?>
        <?php
        if ($currentURL == $customer_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Project Wise Flat Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.find-flat')}}" method="get">
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Project Name: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="project_id" required="">
                                            <option value="">Please select</option>
                                            @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Flat Status:</label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="confirmattion">
                                            <option value="">Please select</option>
                                            <option value="1">Sold</option>
                                            <option value="2">UnSold</option>
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
        if ($currentURL == $sold_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Sold Flat Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.find-sold-flat')}}" method="get">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Project Name: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="project_id" required="">
                                            <option value="">Please select</option>
                                            @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
            <?php
        }
        ?>

        <?php
        if ($currentURL == $status_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Status Wise Customer Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.find-status-customer')}}" method="get">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Type Name: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="type_id" required="">
                                            <option value="">Please select</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
            <?php
        }
        ?>

         <?php
         if ($currentURL == $user_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">User Wise Customer Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.find-user-status-customer')}}" method="get">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">User Name: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="creator_id" required="">
                                            <option value="">Please select</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
            <?php
        }
        ?>
	</div>
</div>
@endsection
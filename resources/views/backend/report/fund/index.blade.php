@extends('backend.layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
        <?php
            $currentURL = URL::current();
            $fund_url = url('/admin/report/fund-report');
            $user_fund_url = url('/admin/report/user-fund-report');
        ?>
        <?php
        if ($currentURL == $fund_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">Fund Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.fund')}}" method="get">
                        	<div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Fund Categoies: </label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="category_id">
                                            <option value="">Please select</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
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
        if ($currentURL == $user_fund_url) {
            ?>
            <div class="col-xl-6 single-filed">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-white">User Wise Fund Report</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{route('report.user.fund')}}" method="get">
                        	<div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Fund Categoies: </label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="category_id">
                                            <option value="">Please select</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        	<div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-12" for="status">Source of Fund: <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="user_id" required="">
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
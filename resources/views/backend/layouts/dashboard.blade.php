@extends('backend.layouts.app')
@section('content')

<!-- Page Content -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full bg-pattern" style="background-image: url('/asset/backend_asset/assets/media/photos/bg-pattern-inverse.png');">
            <div class="py-20 text-center">
                <h2 class="font-w700 text-black mb-10" style="font-family: Poppins,system-ui,-apple-system,Segoe UI,Roboto,Helvetica Neue,Noto Sans,Liberation Sans,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color emoji;">
                    Arba Housing CRM Dashboard
                </h2>
            </div>
        </div>
    </div>
    <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-money fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="{{$total_fund}}">{{$total_fund}}</div>
                    <div class="font-size-sm font-w600 text-muted">Total<br>Fund Collection</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-money fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="{{$today_fund}}" class="js-count-to-enabled">{{$today_fund}}</span></div>
                    <div class="font-size-sm font-w600 text-muted">Today<br>Fund Collection</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-won fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="{{$total_withdraw}}">{{$total_withdraw}}</div>
                    <div class="font-size-sm font-w600 text-muted">Total<br>Fund Withdraw</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-won fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="{{$today_withdraw}}">{{$today_withdraw}}</div>
                    <div class="font-size-sm font-w600 text-muted">Today<br>Fund Withdraw</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-stack-exchange fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="{{$total_expense}}">{{$total_expense}}</div>
                    <div class="font-size-sm font-w600 text-muted">Total<br>Office Expense</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-stack-exchange fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="{{$today_expense}}" class="js-count-to-enabled">{{$today_expense}}</span></div>
                    <div class="font-size-sm font-w600 text-muted">Today<br>Office Expense</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa fa-exchange fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="{{$total_transaction}}">{{$total_transaction}}</div>
                    <div class="font-size-sm font-w600 text-muted">Total<br>Stock Transaction</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa fa-exchange fa-3x text-body-bg-dark"></i>
                    </div>
                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="{{$today_transaction}}" class="js-count-to-enabled">{{$today_transaction}}</span></div>
                    <div class="font-size-sm font-w600 text-muted">Today<br>Stock Transaction</div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
    <!-- END Page Content -->
</div>
@endsection
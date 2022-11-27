<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary text-white" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->
            <a href="{{route('notification.list')}}" class="btn btn-rounded btn-dual-secondary text-white" id="page-header-notifications">
                <i class="fa fa-bell"></i>
                <?php
                    if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                        $total_notification = App\Models\Customer::whereDate('remember_time', '=', date('Y-m-d'))->where('notify_status',1)->count();    
                    }else if(Auth::user()->role_id == 3){
                        $total_notification = App\Models\Customer::where('creator_id',Auth::user()->id)->where('reference_id',Auth::user()->id)->whereDate('remember_time', '=', date('Y-m-d'))->where('notify_status',1)->count();
                    }else if(Auth::user()->role_id == 4){
                        $total_notification = App\Models\Customer::where('creator_id',Auth::user()->id)->whereDate('remember_time', '=', date('Y-m-d'))->where('notify_status',1)->count();
                    }
                ?>
                <span class="badge badge-primary badge-pill" id="notification">{{$total_notification}}</span>
            </a>
            <!-- Layout Options (used just for demonstration) -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <a class="btn btn-circle btn-dual-secondary text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <!-- User Dropdown -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary text-white" data-toggle="layout" data-action="side_overlay_toggle">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block text-white">{{Auth::user()->name}}</span>
                </button>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->

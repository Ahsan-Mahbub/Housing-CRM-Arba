<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700">
                        <span class="text-dual-primary-dark">Arba Housing CRM</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="@if(url('/'))active @endif" href="/"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <?php
                if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
                    ?>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-user-secret"></i><span class="sidebar-mini-hide">RBAC</span></a>
                        <ul>
                            <?php
                            if(Auth::user()->role_id == 1){
                                ?>
                                <li>
                                    <a href="{{route('role.list')}}"><span class="sidebar-mini-hide">Role List</span></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li>
                                <a href="{{route('user.list')}}"><span class="sidebar-mini-hide">User List</span></a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-thumb-tack"></i><span class="sidebar-mini-hide">Project</span></a>
                    <ul>
                        <li>
                            <a href="{{route('project.list')}}"><span class="sidebar-mini-hide">Project</span></a>
                        </li>
                        <li>
                            <a href="{{route('flat.list')}}"><span class="sidebar-mini-hide">Flat</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-main-heading"><span class="sidebar-mini-visible">C.S</span><span class="sidebar-mini-hidden">CRM Section</span></li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-users"></i><span class="sidebar-mini-hide">Customers</span></a>
                    <ul>
                        <li>
                            <a href="{{route('reference.list')}}"><span class="sidebar-mini-hide">Reference</span></a>
                        </li>
                        <li>
                            <a href="{{route('customer-status.list')}}"><span class="sidebar-mini-hide">Customer Flat Type</span></a>
                        </li>
                        <li>
                            <a href="{{route('customer.list')}}"><span class="sidebar-mini-hide">Customer</span></a>
                        </li>
                        <li>
                            <a href="{{route('flat-assign.list')}}"><span class="sidebar-mini-hide">Assign Flat</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">C.S</span><span class="sidebar-mini-hidden">Construction Section</span></li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-credit-card"></i><span class="sidebar-mini-hide">Payment Method</span></a>
                    <ul>
                        <li>
                            <a href="{{route('method.list')}}"><span class="sidebar-mini-hide">Payment Method</span></a>
                        </li>
                        <li>
                            <a href="{{route('account.list')}}"><span class="sidebar-mini-hide">Account</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-money"></i><span class="sidebar-mini-hide">Fund</span></a>
                    <ul>
                        <li>
                            <a href="{{route('fund-category.list')}}"><span class="sidebar-mini-hide">Fund Category</span></a>
                        </li>
                        <li>
                            <a href="{{route('fund-user.list')}}"><span class="sidebar-mini-hide">Source of Fund / User</span></a>
                        </li>
                        <li>
                            <a href="{{route('fund.list')}}"><span class="sidebar-mini-hide">Fund</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-list-alt"></i><span class="sidebar-mini-hide">Item</span></a>
                    <ul>
                        <li>
                            <a href="{{route('unit.list')}}"><span class="sidebar-mini-hide">Unit</span></a>
                        </li>
                        <li>
                            <a href="{{route('item.list')}}"><span class="sidebar-mini-hide">Item</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('supplier.list')}}"><i class="fa fa-shopping-basket"></i> <span class="sidebar-mini-hide">Supplier</span></a>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-houzz"></i><span class="sidebar-mini-hide">Stock</span></a>
                    <ul>
                        <li>
                            <a href="{{route('stock.create')}}"><span class="sidebar-mini-hide">Add Stock</span></a>
                        </li>
                        <li>
                            <a href="{{route('stock.list')}}"><span class="sidebar-mini-hide">Stock List</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-window-close"></i><span class="sidebar-mini-hide">Stock Clear</span></a>
                    <ul>
                        <li>
                            <a href="{{route('stock.clear.create')}}"><span class="sidebar-mini-hide">Add Stock Clear</span></a>
                        </li>
                        <li>
                            <a href="{{route('stock.clear.list')}}"><span class="sidebar-mini-hide">Stock Clear List</span></a>
                        </li>
                    </ul>
                </li>  
                <li class="nav-main-heading"><span class="sidebar-mini-visible">E.S</span><span class="sidebar-mini-hidden">Expense Section</span></li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-exchange"></i><span class="sidebar-mini-hide">Stock Transaction</span></a>
                    <ul>
                        <li>
                            <a href="{{route('transaction.create')}}"><span class="sidebar-mini-hide">Add Transaction</span></a>
                        </li>
                        <li>
                            <a href="{{route('transaction.list')}}"><span class="sidebar-mini-hide">Transaction List</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-won"></i><span class="sidebar-mini-hide">Fund Withdraw</span></a>
                    <ul>
                        <li>
                            <a href="{{route('fund-withdraw.create')}}"><span class="sidebar-mini-hide">Add Fund Withdraw</span></a>
                        </li>
                        <li>
                            <a href="{{route('fund-withdraw.list')}}"><span class="sidebar-mini-hide">Fund Withdraw List</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-stack-exchange"></i><span class="sidebar-mini-hide">Office Expense</span></a>
                    <ul>
                        <li>
                            <a href="{{route('office-expense.create')}}"><span class="sidebar-mini-hide">Add Office Expense</span></a>
                        </li>
                        <li>
                            <a href="{{route('office-expense.list')}}"><span class="sidebar-mini-hide">Office Expense List</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">C.S</span><span class="sidebar-mini-hidden">Report Section</span></li>
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-file"></i><span class="sidebar-mini-hide">Customer Report</span></a>
                    <ul>
                        <li>
                            <a href="{{route('customer.report.index')}}"><span class="sidebar-mini-hide">Project Wise Flat Report</span></a>
                        </li>
                        <li>
                            <a href="{{route('sold.report.index')}}"><span class="sidebar-mini-hide">Sold Flat Report</span></a>
                        </li>
                        <!-- <li>
                            <a href="{{route('status.report.index')}}"><span class="sidebar-mini-hide">Status Wise Customer Report</span></a>
                        </li> -->
                        <li>
                            <a href="{{route('user.report.index')}}"><span class="sidebar-mini-hide">User Wise Customer Report</span></a>
                        </li>
                    </ul>
                </li>
                @endif
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-file-o"></i><span class="sidebar-mini-hide">Fund Report</span></a>
                    <ul>
                        <li>
                            <a href="{{route('fund.report.index')}}"><span class="sidebar-mini-hide">Fund Report</span></a>
                        </li>
                        <li>
                            <a href="{{route('user.fund.report.index')}}"><span class="sidebar-mini-hide">User Fund Report</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-file"></i><span class="sidebar-mini-hide">Withdraw Report</span></a>
                    <ul>
                        <li>
                            <a href="{{route('withdraw.report.index')}}"><span class="sidebar-mini-hide">Withdraw Report</span></a>
                        </li>
                        <li>
                            <a href="{{route('user.withdraw.report.index')}}"><span class="sidebar-mini-hide">User Withdraw Report</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('expense.report.index')}}"><i class="fa fa-file-o"></i> <span class="sidebar-mini-hide">Expense Report</span></a>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-file"></i><span class="sidebar-mini-hide">Stock Report</span></a>
                    <ul>
                        <li>
                            <a href="{{route('project.stock.report.index')}}"><span class="sidebar-mini-hide">Project Wise Stock Report</span></a>
                        </li>
                        <li>
                            <a href="{{route('supplier.stock.report.index')}}"><span class="sidebar-mini-hide">Supplier Wise Stock Report</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->

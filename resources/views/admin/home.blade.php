@extends('admin.layout.index')


@section('content')

    <div class="page-content">

        <!-- BEGIN PAGE BAR -->
    @include('admin.layout.breadcrumb')
    <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> لوحة التحكم
            <small></small>
        </h1>
        <!-- END PAGE TITLE-->


        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('admin.auth.profile')}}">
                    <div class="visual">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value=" "> </span>
                        </div>
                        <div class="desc"> البروفايل </div>
                    </div>
                </a>
            </div>
            @can('customer-list')
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('customer.index')}}">
                <div class="visual">
                    <i class="fa fa-user-friends"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value=""></span>
                     </div>
                    <div class="desc"> لوحة الزبائن </div>
                </div>
            </a>
        </div>
            @endcan
            @can('customer-employee-list')
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('employee_customer.index')}}">
                        <div class="visual">
                            <i class="fa fa-user-friends"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value=""></span>
                            </div>
                            <div class="desc"> لوحة الزبائن </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('order-employee-list')
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('employee_order.index')}}">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value=""></span>
                    </div>
                    <div class="desc">مشاريع القسم </div>
                </div>
            </a>
        </div>
            @endcan
            @can('task-employee-list')
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{route('employee_task.index')}}">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value=""></span>
                    </div>
                    <div class="desc">مهام القسم</div>
                </div>
            </a>
        </div>
            @endcan
            @can('msg-employee-list')
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="{{route('msg_employee.index')}}">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value=""></span>
                    </div>
                    <div class="desc">محادثات الزبائن</div>
                </div>
            </a>
        </div>
            @endcan

    </div>
 



    </div>


    @endsection





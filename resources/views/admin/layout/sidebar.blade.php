<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

            <li class="nav-item start active open">
                <a href="{{route('admin.home')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">الصفحة الرئيسية</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start">
                <a href="{{route('admin.auth.profile')}}" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">البروفايل</span>
                    <span class="selected"></span>
                </a>
            </li>

            @can('user-list')
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">مستخدمي لوحة التحكم</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('users')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">جميع المستخدمين</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start active open">
                        <a href="{{route('users.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة مستخدم</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">الصلاحيات</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('roles.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">عرض</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start active open">
                        <a href="{{route('roles.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة </span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @can('customer-list')
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title"> لوحة المستخدمين</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('customer.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">جميع المستخدمين</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start active open">
                        <a href="{{route('customer.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة مستخدم</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan


            @can('faq-list')
                <li class="nav-item start">
                    <a href="{{route('faq.index')}}" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">  الأسئلة الشائعة</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('category-list')
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title"> لوحة الأقسام </span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('category.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">الكل</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start active open">
                        <a href="{{route('category.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة قسم</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('country-list')
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title"> لوحة الدول </span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('country.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">الكل</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start active open">
                        <a href="{{route('country.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة دولة</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('advertisment-list')
            <li class="nav-item start">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title"> لوحة الاعلانات </span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="{{route('advertisment.index')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">الكل</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start active open">
                        <a href="{{route('advertisment.create')}}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">إضافة اعلان</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan


            @can('setting-edit')
            <li class="nav-item start">
                <a href="{{route('setting.index')}}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">لوحة الاعدادات</span>
                    <span class="selected"></span>
                </a>
            </li>
            @endcan

            <!-- employee -->

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

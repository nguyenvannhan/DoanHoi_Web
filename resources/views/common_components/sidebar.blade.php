<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="#" class="site_title center"><img src="{{URL('public/images/banner.png')}}" class="sidebar-banner"></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ URL('public/images/avatars/default.png') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>John Doe</h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý Sinh Viên <span
                                class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="{{ route('student_index_route') }}">Danh Sách Sinh Viên</a></li>
                        <li><a href="{{ route('get_student_add_route') }}">Thêm Sinh Viên</a></li>
                        <li><a href="{{ route('student_get_add_list_route') }}">Import DS Sinh Viên</a></li>
                        <li><a href="{{ route('student_get_add_status_list_route') }}">Import File Tình trạng SV</a></li>
                        <li><a href="{{ route('student_get_export_list_route') }}">Export DS Sinh viên</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-universal-access"></i> Quản Lý Đoàn - NTK <span
                                class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="{{ route('get_unioinist_list') }}">QL Đoàn viên</a></li>
                        <li><a href="{{ route('get_partisan_list') }}">QL CTĐ - Đảng viên</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-bullhorn"></i> Quản Lý Hoạt Động <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="{{ route('activity_index_route') }}">Danh Sách Hoạt Động</a></li>
                        <li><a href="{{ route('get_activity_add_route') }}">Thêm Hoạt Động</a></li>
                        <li><a href="{{ route('get_attender_index_route') }}">Danh sách tham gia</a></li>
                        <li><a href="{{ route('get_import_attender_list_route') }}">Import file DS tham gia</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('class_index_route') }}"><i class="fa fa-group"></i> Quản Lý Lớp Học </a>
                </li>
                <li>
                    <a href="{{ route('science_index_route') }}"><i class="fa fa-book"></i> Quản Lý Khóa Học </a>
                </li>
                <li>
                    <a href="{{ route('school_year_index_route') }}"><i class="fa fa-calendar"></i> Quản Lý Năm Học </a>
                </li>


                <!-- <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý BCH Khoa<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('BCH_Khoa_index_route') }}">Danh Sách Thành Viên</a></li>
                        <li><a href="{{ route('get_BCH_Khoa_Student_add_route') }}">Thêm Thành Viên</a></li>
                        <li><a href="{{ route('BCH_Khoa_add_list_route') }}">Thêm Danh Sách Thành Viên</a></li>
                    </ul>
                </li> -->
                <!-- <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý BCH Lớp <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="{{ route('BCH_Lop_index_route') }}">Danh Sách Thành Viên</a></li>
                        <li><a href="{{ route('BCH_Lop_add_route') }}">Thêm Thành Viên</a></li>
                        <li><a href="{{ route('BCH_Lop_add_list_route') }}">Thêm Danh Sách Thành Viên</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>

    <!-- sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>

<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="#" class="site_title center"><img src="{{URL('images/banner.png')}}" class="sidebar-banner"></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ URL('/images/avatars/default.png') }}" alt="..." class="img-circle profile_img">
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
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý Sinh Viên <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="{{ route('student_index_route') }}">Danh Sách Sinh Viên</a></li>
                        <li><a href="{{ route('student_add_route') }}">Thêm Sinh Viên</a></li>
                        <li><a href="{{ route('student_add_list_route') }}">Thêm Danh Sách Sinh Viên</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('science_index_route') }}"><i class="fa fa-calendar"></i> Quản Lý Khóa Học </a>
                </li>
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý Lớp Học <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="../class/ListClass.html">Danh Sách Khoá Học</a></li>
                        <li><a href="../class/AddClass.html">Thêm Khóa Học</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý Năm Học <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="../scholastic/ListScholastic.html">Danh Sách Năm Học</a></li>
                        <li><a href="../scholastic/AddScholastic.html">Thêm Năm Học</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý Hoạt Động <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="../activity/ListStudentActivity.html">Danh Sách Tham Gia Hoạt Động</a></li>
                        <li><a href="../activity/AddOneStudentActivity.html">Thêm Sinh Viên Tham Gia</a></li>
                        <li><a href="../activity/AddListStudentActivity.html">Thêm Danh Sách Tham Gia</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý BCH Đoàn-Hội <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="#">Danh Sách Thành Viên</a></li>
                        <li><a href="#">Thêm Thành Viên</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-graduation-cap"></i> Quản Lý BCH Lớp <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                        <li><a href="#">Danh Sách BCH Lớp</a></li>
                        <li><a href="#">Thêm Thành Viên</a></li>
                    </ul>
                </li>
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

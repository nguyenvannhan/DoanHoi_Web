<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                   aria-expanded="false">
                    {{ $userName }}
                    <span class="fa fa-angle-down"></span>
                </a>

                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                        <a href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('get_change_pass_route') }}">Đổi mật khẩu</a>
                    </li>
                    <li>
                        <a href="{{ route('get_logout_route') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>

<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('')}}assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        Geneva <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Edit Profile</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Change Password</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>

        </ul>

        <div class="logo-box">
           

            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('')}}assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('')}}assets/images/logo-light.png" alt="" height="20">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>

    </div>
</div>
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        @include('layouts.mainLayout.sidebar')
        <div class="clearfix"></div>
    </div>
</div>
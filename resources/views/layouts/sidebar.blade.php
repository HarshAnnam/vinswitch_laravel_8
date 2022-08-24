 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

<div class="h-100" data-simplebar>

    <!-- User box -->
    <div class="user-box text-center">
        <img src="{{ asset('')}}assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
            class="rounded-circle avatar-md">
        <div class="dropdown">
            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                data-bs-toggle="dropdown">User</a>
            <div class="dropdown-menu user-pro-dropdown">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user me-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-settings me-1"></i>
                    <span>Change Password</span>
                </a>

               
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-log-out me-1"></i>
                    <span>Logout</span>
                </a>

            </div>
        </div>
        <p class="text-muted">Admin Head</p>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul id="side-menu">

            <li class="menu-title">Navigation</li>         

            <li>
                <a href="apps-calendar.html">
                    <i data-feather="airplay"></i>
                    <span> Dashboard </span>
                </a>
                <a href="{{route('userlist')}}">
                    <i data-feather="users"></i>
                    <span> User </span>
                </a>
            </li>

        </ul>

    </div>
    <!-- End Sidebar -->

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
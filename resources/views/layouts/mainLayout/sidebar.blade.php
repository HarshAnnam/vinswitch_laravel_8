<div id="sidebar-menu">
    <ul id="side-menu">
        <li class="menu-title mt-2">Vinswitch</li>
        <li>
            <a href="{{route('dashboard')}}">
                <i data-feather="airplay"></i>
                <span> Dashboard </span>
            </a>

        </li>
        <li>
            <a href="{{route('agentlist')}}">
                <i data-feather="users"></i>
                <span> Agents </span>
            </a>
        </li>
        <li>
            <a href="{{route('dids')}}">
                <i data-feather="users"></i>
                <span> Phone Number </span>
            </a>
        </li>
        <li>
            <a href="{{route('customers')}}">
                <i data-feather="users"></i>
                <span> Customers </span>
            </a>
        </li>
        <li>
            <a href="{{route('acl')}}">
                <i data-feather="settings"></i>
                <span> ACL </span>
            </a>
        </li>
        <li>
            <a href="#sidebarConfiguration" data-bs-toggle="collapse">
                <i data-feather="shopping-cart"></i>
                <span> Configuration </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarConfiguration">
                <ul class="nav-second-level">
                    <li class="">
                        <a href="{{route('gateways')}}">Gateways</a>
                    </li>
                    <li class="">
                        <a href="{{route('sofiarateplan')}}">Tremination RatePlan</a>
                    </li>
                    <li class="">
                        <a href="ecommerce-products.html">Bill Plan</a>
                    </li>
                    <li class="">
                        <a href="ecommerce-products.html">NPA/NXX</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
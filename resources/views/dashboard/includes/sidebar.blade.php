<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        {{-- <li>
            <a href="index.html" class="waves-effect">
                <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                <span>Dashboard</span>
            </a>
        </li> --}}

        <li class = "{{request()->routeIs('dashboard.educational_stage.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.educational_stage.index')}}" class=" waves-effect">
                <i class="ri-calendar-2-line"></i>
                <span>{{__('sidebar.educational_stages')}}</span>
            </a>
        </li>

        <li class = "{{request()->routeIs('dashboard.class_room.*') ? 'mm-active' : ''}}">
            <a href="{{route('dashboard.class_room.index')}}" class=" waves-effect">
                <i class="ri-chat-1-line"></i>
                <span>{{__('sidebar.class_rooms')}}</span>
            </a>
        </li>

        {{--
        <li class="menu-title">Pages</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-account-circle-line"></i>
                <span>Authentication</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="auth-login.html">Login</a></li>
                <li><a href="auth-register.html">Register</a></li>
                <li><a href="auth-recoverpw.html">Recover Password</a></li>
                <li><a href="auth-lock-screen.html">Lock Screen</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-profile-line"></i>
                <span>Utility</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="pages-starter.html">Starter Page</a></li>
                <li><a href="pages-maintenance.html">Maintenance</a></li>
                <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                <li><a href="pages-timeline.html">Timeline</a></li>
                <li><a href="pages-faqs.html">FAQs</a></li>
                <li><a href="pages-pricing.html">Pricing</a></li>
                <li><a href="pages-404.html">Error 404</a></li>
                <li><a href="pages-500.html">Error 500</a></li>
            </ul>
        </li>
        --}}
    </ul>
</div>
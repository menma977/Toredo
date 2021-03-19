<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="index.html" class="sidebar-title">
            <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide">App<strong>UI</strong></span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is(['dashboard', 'dashboard/*']) ? 'active' : '' }}"><i
                            class="gi gi-compass sidebar-nav-icon"></i><span
                            class="sidebar-nav-mini-hide">Dashboard</span></a>
                </li>
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                <li>
                    <a href="{{ route('bank') }}"
                        class="nav-link {{ request()->is(['bank', 'bank/*']) ? 'active' : '' }}">
                        <i class="sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-credit_card sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Bank</span>
                    </a>

                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu"><i
                            class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                            class="gi gi-airplane sidebar-nav-icon"></i><span
                            class="sidebar-nav-mini-hide">Components</span></a>
                    <ul>
                        <li>
                            <a href="page_comp_todo.html">To-do List</a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                <li>
                    <a href="{{ route('bank') }}"
                        class="nav-link {{ request()->is(['bank', 'bank/*']) ? 'active' : '' }}">
                        <i class="sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-credit_card sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Bank</span>
                    </a>
                </li>

                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="hi hi-off sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>

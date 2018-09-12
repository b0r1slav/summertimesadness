<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-trophy"></i> Improvement <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('evaluations.index') }}">Users</a></li>
                    <li><a href="{{ route('points-approvement') }}">Points approvement <span id="pa-count" class="badge bg-red"></span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
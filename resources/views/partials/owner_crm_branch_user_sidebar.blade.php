
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('/')}}" class="sidebar-brand" data-bs-toggle="tooltip" data-bs-placement="right" title=""></a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{route('/')}}" class="nav-link"><i class="link-icon" data-feather="home"></i><span class="link-title">Dashboard</span></a>
            </li>

            @if($user->type == 'owner' || $user->type == 'admin_helper')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin_settings" role="button" aria-expanded="false" aria-controls="uiComponents">
                <i class="link-icon" data-feather="settings"></i>
                <span class="link-title">Settings & Others</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="admin_settings">
                <ul class="nav sub-menu">

                    @if($user->hasPermissionTo('admin.setting') || $user->type == 'owner')
                    <li class="nav-item">
                        <a href="{{route('admin.school_setting')}}" class="nav-link">School Settings</a>
                    </li>
                    @endif

                    @if($user->hasPermissionTo('admin.helper.role.permission') || $user->type == 'owner')
                    <li class="nav-item">
                        <a href="{{route('admin.helper_role_permission')}}" class="nav-link">Admin Helper Roll</a>
                    </li>
                    @endif
                </ul>
                </div>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#branch_settings" role="button" aria-expanded="false" aria-controls="uiComponents">
                <i class="link-icon" data-feather="feather"></i>
                <span class="link-title">Branch</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="branch_settings">
                <ul class="nav sub-menu">

                    @if($user->hasPermissionTo('branch') || $user->type == 'owner')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.all.branch')}}">
                            <span class="nav-main-link-name">All Branch</span>
                        </a>
                    </li>
                    @endif

                    @if($user->hasPermissionTo('branch.role.permission') || $user->type == 'owner')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.branch.role')}}">
                            <span class="nav-main-link-name">Branch role & permission</span>
                        </a>
                    </li>
                    @endif

                </ul>
                </div>
            </li>

            @if($user->hasPermissionTo('admin.crm') || $user->type == 'owner')
            <li class="nav-item">
                <a href="{{route('admin.crm')}}" class="nav-link"><i class="link-icon" data-feather="users"></i><span class="link-title">CRM</span></a>
            </li>
            @endif
            

            

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                <i class="link-icon" data-feather="feather"></i>
                <span class="link-title">UI Kit</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
                    </li>
                </ul>
                </div>
            </li>

        
        </ul>
    </div>
</nav>
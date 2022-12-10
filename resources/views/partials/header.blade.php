<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown" style="margin-right: 20px !important;">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">Session: 2017</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i> <span class="ms-1"> French </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ms-1"> German </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i> <span class="ms-1"> Portuguese </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es" id="es"></i> <span class="ms-1"> Spanish </span></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="../assets/images/faces/face1.jpg" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="../assets/images/faces/face1.jpg" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ $user->name }}</p>
                            <p class="tx-12 text-muted">@if($user->type == 'owner') Admin @else {{str_replace($user->shop_id."#","", $user->getRoleNames())}}  @endif</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                    <li class="dropdown-item py-2">
                        <a href="{{ route('profile.show') }}" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="user"></i>
                        <span>Profile</span>
                        </a>
                    </li>
                    <li class="dropdown-item py-2">
                        <a href="{{route('my.moments')}}" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>My Moments</span>
                        </a>
                    </li>
                    <li class="dropdown-item py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="font-size-sm font-w500">Log Out</span>
                            </a>
                        </form>
                    </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
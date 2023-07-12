<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <img class="img-fluid img_styling">

                </li>
            </ul>
        </div>
        @auth
            <ul class="nav navbar-nav align-items-center ms-auto">

                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                </li>

                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @php

                            $user = auth()->user();
                            $username = auth()->user()->name;
                            $role = auth()->user()->role;
                            $roleName = \App\Utils\Common\UserRoles::ALL[$role];

                        @endphp
                        <div class="user-nav d-sm-flex d-none me-1">
                            <span class="user-name fw-bolder">{{ $username }}</span>
                            <span class="user-status">{{$roleName}}</span>
                        </div>
                        <span class="avatar">
                            {{-- <img class="round" src="{{asset('storage/'.$avatar)}}" alt="avatar" height="40" width="40">
                        --}}
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdown-user">
                        {{-- <a class="dropdown-item"
                        href="{{(auth()->user()->isAdmin)? route('profile.edit.security', auth()->user()->username) : route('user.show', auth()->user()->username)}}">
                        <i class="me-50" data-feather="user"></i>
                        Profile
                    </a> --}}
                        {{-- <a class="dropdown-item" href="#"> --}}
                        {{-- <i class="me-50" data-feather="settings"></i> --}}
                        {{-- Settings --}}
                        {{-- </a> --}}
                            {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profile-modal">
                                <i class="me-50" data-feather="arrow-up-circle"></i>
                                Profile
                            </a> --}}
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</nav>
<!-- END: Header-->

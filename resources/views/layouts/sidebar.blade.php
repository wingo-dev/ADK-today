<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item ">
                <a class=" d-flex align-items-center navbar-brand" href="{{route('home')}}">
                    {{-- <img src="{{asset('lms/app-assets/images/logo.svg')}}" style="object-fit:contain; height:55px;width:45px"> --}}
                    {{-- <h2 class="brand-text" style="font-variant: small-caps">Unili</h2> --}}
                    <img src="{{ asset('assets/images/logo/logo.png') }}"
                        style="object-fit:contain;height: 35px;width: 180px;">
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc">
                    </i>
                </a>
            </li>
        </ul>
    </div>



    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item ">
                <a class="d-flex align-items-center" href="{{route('home')}}">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate">Home</span>
                </a>
            </li>
            {{-- <li class="nav-item ">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="grid"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li> --}}
            @auth
            <li class="">
                <a class="d-flex align-items-center" href="{{route('profile')}}">
                    <i data-feather="user-check"></i>
                    <span class="menu-item text-truncate" data-i18n="Profile">Profile</span>
                </a>
            </li>
            @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN)
            <li class="">
                <a class="d-flex align-items-center" href="{{route('password-change')}}">
                    <i data-feather="key"></i>
                    <span class="menu-item text-truncate" data-i18n="Profile">Change Password</span>
                </a>
            </li>
            @endif


            {{-- header --}}
            
            @if(auth()->user()->role != \App\Utils\Common\UserRoles::USER)
            <li class="navigation-header">
                <span>Management</span>
                <i data-feather="more-horizontal"></i>
            </li>
            @endif
            @auth


            @endauth
            @if (auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN)


            <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Users</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('ban-users.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('ban-users.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Banned Users</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('counties.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('counties.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Counties</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('towns.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('towns.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Towns</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('categories.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Categories</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('tags.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('tags.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Tags</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('events.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('events.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Events</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR || auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)

            {{-- <li class="nav-item {{ request()->routeIs('events.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('events.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Events</span>
                </a>
            </li> --}}

            @endif

            @if (auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)

            <li class="nav-item {{ request()->routeIs('events.*') ? 'active' : null }}">
                <a class="d-flex align-items-center" href="{{ route('events.index') }}">
                    <i data-feather='server'></i>
                    <span class="menu-title text-truncate">Events</span>
                </a>
            </li>

            @endif


            {{-- @role(\App\Utils\Common\UserRoles::SUPER_ADMIN)
                <li class="nav-item {{ request()->routeIs('admin.roles.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.roles.index') }}">
                        <i data-feather='server'></i>
                        <span class="menu-title text-truncate">Roles</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.doctors.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.doctors.index') }}">
                        <i data-feather="users"></i>
                        <span class="menu-title text-truncate">Doctor</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('patients.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('patients.index') }}">
                        <i data-feather='menu'></i>
                        <span class="menu-title text-truncate">Patient</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('institutes.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('institutes.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Institutes</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('appointments.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('appointments.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Appointments</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('invoices.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('invoices.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Invoices</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('payments.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('payments.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Payments</span>
                    </a>
                </li>
            @endrole

            @role(\App\Utils\Common\UserRoles::PATIENT)
                <li class="nav-item {{ request()->routeIs('appointments.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('appointments.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Appointments</span>
                    </a>
                </li>
            @endrole

            @role(\App\Utils\Common\UserRoles::DOCTOR)
                <li class="nav-item {{ request()->routeIs('patient') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('patients.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Doctor Patients Dummy</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('doctor.calender.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('doctor.calender.index') }}">
                        <i data-feather='menu'></i>
                        <span class="menu-title text-truncate">Calender</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('patients.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('patients.index') }}">
                        <i data-feather='menu'></i>
                        <span class="menu-title text-truncate">Patient</span>
                    </a>
                </li>

                <li class="">
                    <a class="d-flex align-items-center" href="{{ route('institutes.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Institutes</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('institutes.index') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('institutes.index') }}">
                                <i data-feather="home"></i>
                                <span class="menu-item text-truncate" data-i18n="Security">All Institutes</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('doctor.institutes.addPatient') ? 'active' : null }}">
                            <a class="d-flex align-items-center" href="{{ route('doctor.institutes.addPatient') }}">
                                <i data-feather="link"></i>
                                <span class="menu-item text-truncate" data-i18n="Account">Add Patients To Institute</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endrole

            @role(\App\Utils\Common\UserRoles::CLINIC_OWNER)
                <li class="">
                    <a class="d-flex align-items-center" href="{{ route('owner.institutes.index') }}"
                        class="{{ request()->routeIs('owner.institutes.index') ? 'active' : null }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Institutes</span>
                    </a>
                    <ul class="menu-content" class="{{ request()->routeIs('owner.institutes.index') ? 'active' : null }}">
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('owner.institutes.index') }}">
                                <i data-feather="home"></i>
                                <span class="menu-item text-truncate" data-i18n="Institute">All Institutes</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('owner.doctors.index') ? 'active' : null }}">
                            <a class="d-flex align-items-center" href="{{ route('owner.doctors.index') }}">
                                <i data-feather="home"></i>
                                <span class="menu-item text-truncate" data-i18n="Doctors">Doctors</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('owner.user.invite') }}">
                                <i data-feather="link"></i>
                                <span class="menu-item text-truncate" data-i18n="Account">Staff</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('appointments.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('appointments.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Reports</span>
                    </a>
                </li>
            @endrole
            @role(\App\Utils\Common\UserRoles::MANAGER)
                <li class="nav-item {{ request()->routeIs('manager.institutes.index') ? 'active' : null }}">
                    <a class="d-flex align-items-center" href="{{ route('manager.institutes.index') }}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Institutes</span>
                    </a>
                </li>
            @endrole --}}
            @endauth

        </ul>
    </div>
</div>

<!-- END: Main Menu-->

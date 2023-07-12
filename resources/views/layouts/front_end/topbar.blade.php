<nav class="navbar navbar-expand-lg navbar-dark " id="mainNav">
    <div class="container">
        <a class="navbar-brand text-white" href="{{route('home')}}">ADK-Today</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                @auth
                
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                @if(auth()->user()->role != \App\Utils\Common\UserRoles::USER)
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{route('profile')}}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                
                @php
                    $username = auth()->user()->name;
                    $role = auth()->user()->role;
                    $roleName = \App\Utils\Common\UserRoles::ALL[$role];
                @endphp
                <li class="nav-item"><span class="nav-link fw-bolder">{{ $username }}</span></li>
                
                @else
                <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                
                @endauth
            </ul>
        </div>
    </div>
</nav>



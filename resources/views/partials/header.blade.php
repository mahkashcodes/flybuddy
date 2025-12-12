<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-plane text-primary"></i>
            <span class="fw-bold text-primary">Fly</span><span class="fw-bold text-warning">Buddy</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('destinations.index') || request()->routeIs('destinations.show') ? 'active' : '' }}" href="{{ route('destinations.index') }}">
                        <i class="fas fa-globe-americas"></i> Destinations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('packages.index') || request()->routeIs('packages.show') ? 'active' : '' }}" href="{{ route('packages.index') }}">
                        <i class="fas fa-suitcase"></i> Travel Packages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </li>
                
            
                
                @auth
                    <!-- Admin Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield"></i> {{ Auth::user()->name }}
                            <span class="badge bg-danger ms-1">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <h6 class="dropdown-header">Quick Actions</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('destinations.create') }}">
                                    <i class="fas fa-plus-circle me-2 text-success"></i> Add Destination
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('packages.create') }}">
                                    <i class="fas fa-plus-circle me-2 text-success"></i> Add Package
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('destinations.index') }}">
                                    <i class="fas fa-list me-2 text-info"></i> Manage Destinations
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('packages.index') }}">
                                    <i class="fas fa-list me-2 text-info"></i> Manage Packages
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none p-0 w-100 text-start">
                                        <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Guest User Links - Only Admin Login, Register hidden -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ms-2 {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            <i class="fas fa-user-shield"></i> Admin Login
                        </a>
                    </li>
                    <!-- Register link completely removed from navbar -->
                @endauth
            </ul>
        </div>
    </div>
</nav>
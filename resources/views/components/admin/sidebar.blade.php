<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ route('home') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"></i><img style="max-width: 12rem; max-height: fit-content;" src="{{ $data->logo }}"
                    alt="Fibrotech logo"></h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="/storage/user.png" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item nav-link {{ isRouteActive(['admin.dashboard']) ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ isRouteActive(['categories.index', 'categories.create', 'categories.edit']) ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Categories</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('categories.index') }}" class="dropdown-item">Categories</a>
                    <a href="{{ route('categories.create') }}" class="dropdown-item">Add Category</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ isRouteActive(['banner.index', 'banner.create', 'banner.edit']) ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fas fa-scroll me-2"></i>Banners</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('banner.index') }}" class="dropdown-item">Banners</a>
                    <a href="{{ route('banner.create') }}" class="dropdown-item">Create Banner</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ isRouteActive(['brand.index', 'brand.create', 'brand.edit']) ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fas fa-copyright me-2"></i></i></i>Brands</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('brand.index') }}" class="dropdown-item">Brands</a>
                    <a href="{{ route('brand.create') }}" class="dropdown-item">Create Brand</a>
                </div>
            </div>
            <a href="{{ route('admin.settings') }}"
                class="nav-item nav-link {{ isRouteActive(['admin.settings']) ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Settings</a>
        </div>
    </nav>
</div>

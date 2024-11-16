<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">Kompensasi JTI Polinema</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Mallexibra</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{request()->is('dashboard*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/activity" class="nav-link {{request()->is('activity*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Activity</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/compensation" class="nav-link {{request()->is('compensation*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Compensation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link {{request()->is('logout*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

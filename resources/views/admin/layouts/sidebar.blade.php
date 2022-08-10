<div class="col-md-3 ps-0 pe-0 bg-ungu2">
    <div class="d-flex flex-column flex-shrink-0 p-4 bg-ungu2 sidebar-new text-white">
        <div class="d-flex flex-column align-items-start mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
            <span class="fs-5 fw-bold">{{ auth()->user()->name }}</span>
            <span>({{ auth()->user()->email }})</span>
        </div>
        <hr />
        @php
            $route_name = \Route::currentRouteName();
        @endphp
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{ url('admin/home') }}" class="btn btn-toggle align-items-center rounded {{ $route_name == 'admin.home' ? 'active' : '' }}">
                    <i class="fa fa-tachometer me-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('admin/user') }}" class="btn btn-toggle align-items-center rounded {{ $route_name == 'user.index' ? 'active' : '' }}">
                    <i class="fa fa-users me-2"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="{{ url('admin/gedung') }}" class="btn btn-toggle align-items-center rounded {{ $route_name == 'gedung.index' ? 'active' : '' }}">
                    <i class="fa fa-building me-2"></i>
                    Gedung
                </a>
            </li>
            <li>
                <a href="{{ url('admin/reservasi') }}" class="btn btn-toggle align-items-center rounded {{ $route_name == 'reservasi.index' ? 'active' : '' }}">
                    <i class="fa fa-calendar me-2"></i>
                    Reservasi
                </a>
            </li>
            <hr />
            <li>
                <a href="{{ url('admin/website') }}" class="btn btn-toggle align-items-center rounded {{ $route_name == 'admin.website' ? 'active' : '' }}">
                    <i class="fa fa-cogs me-2"></i>
                    Pengaturan Website
                </a>
            </li>
        </ul>
    </div>
</div>
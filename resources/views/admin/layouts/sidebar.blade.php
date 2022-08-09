<div class="col-md-3 ps-0 pe-0 bg-ungu2">
    <div class="d-flex flex-column flex-shrink-0 p-4 bg-ungu2 sidebar-new text-white">
        <div class="d-flex flex-column align-items-start mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
            <span class="fs-5 fw-bold">{{ auth()->user()->name }}</span>
            <span>({{ auth()->user()->email }})</span>
        </div>
        <hr />
        <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a href="{{ url('admin/home') }}"
                                class="btn btn-toggle align-items-center rounded active">
                                <i class="fa fa-tachometer me-2"></i>
                                Dashboard
                            </a>
                        </li>
        </ul>
    </div>
</div>
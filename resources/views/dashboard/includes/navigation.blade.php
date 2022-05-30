<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">

    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
        <i class="fa fa-list"></i>
    </button>

    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('dashboard') }}">
        {{ env('APP_NAME') }}
    </a>

    <ul class="navbar-nav align-items-center ms-auto">

        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-fluid" src="https://ui-avatars.com/api/?size=128&name={{ auth()->user()->name }}" />
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="https://ui-avatars.com/api/?size=128&name={{ auth()->user()->name }}" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="dropdown-user-details-email">
                            <a href="javascript:void(0)">
                                {{ auth()->user()->email }}
                            </a>
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>

                <form id="logout-form" action="{{ url('logout') }}?continue={{ urlencode(url()->current()) }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>
</nav>
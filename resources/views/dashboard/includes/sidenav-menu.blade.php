<div class="nav accordion" id="accordionSidenav">
    <!-- Sidenav Menu Heading (Account)-->
    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
    <div class="sidenav-menu-heading d-sm-none">Account</div>
    <!-- Sidenav Link (Alerts)-->
    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
    <a class="nav-link d-sm-none" href="#!">
        <div class="nav-link-icon"><i data-feather="bell"></i></div>
        Alerts
        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
    </a>
    <!-- Sidenav Link (Messages)-->
    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
    <a class="nav-link d-sm-none" href="#!">
        <div class="nav-link-icon"><i data-feather="mail"></i></div>
        Messages
        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
    </a>
    <!-- Sidenav Menu Heading (Core)-->
    <div class="sidenav-menu-heading">Navigation</div>

    <a class="nav-link @if(request()->segment(2) == '') active @endif" href="{{ route('dashboard') }}">
        <div class="nav-link-icon"><i class="fa fa-home"></i></div> Dashboard
    </a>

    <a class="nav-link @if(request()->segment(2) == 'phone-numbers') active @endif" href="{{ route('dashboard') }}">
        <div class="nav-link-icon">
            <i class="fa fa-mobile"></i>
        </div> Phone Numbers
    </a>

</div>

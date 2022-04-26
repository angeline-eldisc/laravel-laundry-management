<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/outlet/laundry-logo-icon.png') }}" alt="Laundry" style="width: 55px"/>
            <p class="text-black d-inline fs-28" style="vertical-align: middle;"><strong>LAUNDRY</strong></p>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @if(Auth::user()->role == 'cashier' || Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-user"></i>Manage Users</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{ route('users.admin.index') }}">Admin</a>
                        </li>
                        <li>
                            <a href="{{ route('users.cashier.index') }}">Cashier</a>
                        </li>
                        <li>
                            <a href="{{ route('users.owner.index') }}">Owner</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->role == 'owner')
                <li>
                    <a href="{{ route('outlet.index') }}">
                        <i class="fas fa-home"></i>Profile Outlet</a>
                </li>
                @endif
                <li>
                    <a href="{{ route('packages.index') }}">
                        <i class="fas fa-box"></i>Laundry Package</a>
                </li>
                <li>
                    <a href="{{ route('members.index') }}">
                        <i class="fas fa-user"></i>Members</a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}">
                        <i class="fas fa-exchange-alt"></i>Transaction</a>
                </li>
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                <li>
                    <a href="{{ route('reports.index') }}">
                        <i class="fas fa-file-alt"></i>Report</a>
                </li>
                @endif
                @endif
            </ul>
        </nav>
    </div>
</aside>

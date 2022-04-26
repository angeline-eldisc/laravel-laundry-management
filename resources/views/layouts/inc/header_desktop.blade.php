<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header"></div>
                <div class="header-button">
                    <div class="noti-wrap"></div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                @if (Auth::user()->profile == '')
                                    <img src="{{ asset('images/default.png') }}" width="45" alt="user" />
                                @else
                                    <img src="{{ asset('images/users/' . Auth::user()->profile) }}" width="45" alt="user" />
                                @endif
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->profile == '')
                                                <img src="{{ asset('images/default.png') }}" alt="user" />
                                            @else
                                                <img src="{{ asset('images/users/' . Auth::user()->profile) }}" alt="user" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->role }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="
                                        @if (Auth::user()->role == 'admin')
                                            {{ route('users.admin.show', Auth::user()->id) }}
                                        @elseif (Auth::user()->role == 'cashier')
                                            {{ route('users.cashier.show', Auth::user()->id) }}
                                        @else
                                            {{ route('users.owner.show', Auth::user()->id) }}
                                        @endif">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="{{ Route('users.resetPassword', Auth::user()->id) }}">
                                            <i class="zmdi zmdi-settings"></i>Reset Password</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="zmdi zmdi-power"></i>{{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

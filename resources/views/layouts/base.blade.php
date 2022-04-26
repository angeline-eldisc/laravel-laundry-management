<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} @yield('title')</title>
    <link rel="icon" href="{{ asset('images/outlet/laundry-logo-icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap"rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/3f6c569241.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar fixed-top">
        <div class="navbar_container">
            <a href="{{ route('home') }}" id="navbar_logo">
                <img src="{{ asset('images/outlet/laundry-logo-icon.png') }}" alt="Logo Icon" style="width: 75px;"> {{ $title }}
            </a>
            <div class="navbar_toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar_menu">
                <li class="navbar__item">
                    <a href="{{ route('home') }}" class="navbar_link">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('about') }}" class="navbar_link">About</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('track.laundry') }}" class="navbar_link">Track Your Laundry</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('contact') }}" class="navbar_link">Contact Us</a>
                </li>
                @auth
                <li class="navbar__item">
                    <a href="{{ route('dashboard') }}" class="button navbar_btn">Back To Dashboard</a>
                </li>
                @else
                <li class="navbar__item">
                    <a href="{{ route('login') }}" class="button navbar_btn">Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- Footer Section -->
    <div class="footer_container">
        <section class="social_media">
            <div class="social_media-wrap">
                <div class="footer_logo">
                    <a href="/" id="footer_logo">
                        <img src="{{ asset('images/outlet/laundry-logo-icon.png') }}" alt="Logo Icon" style="width: 75px;"> {{ $title }}
                    </a>
                </div>
                <p class="website_rights">Copyright &copy; {{ $title }} 2022 by Group 3 - Final PDT. All rights reserved.</p>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        const menu = document.querySelector("#mobile-menu");
        const menuLinks = document.querySelector(".navbar_menu");

        menu.addEventListener('click', function() {
            menu.classList.toggle('is-active');
            menuLinks.classList.toggle('active');
        });
    </script>
</body>
</html>

@extends('layouts.base')

@section('title', ' - About')

@section('content')
<!-- Hero Sections -->
<div class="main" style="padding-top: 80px;">
    <div class="main_container">
        <div class="main_img-container">
            <img src="{{ asset('frontend/images/about.svg') }}" alt="Picture 3" id="about_img">
        </div>
        <div class="main_content left-content">
            <h1>Laundry Management</h1>
            <h2>About</h2>
            <p>All about this website is in here.</p>
            <a href="#about">
                <button class="main_btn">
                    Read More
                </button>
            </a>
        </div>
    </div>
</div>

<div class="main" id="about"><div class="divider"></div></div>

<!-- About Sections -->
<div class="main">
    <div class="containers">
        <div class="main_content">
            <h2>About</h2>
            <p class="about-paragraph paragraph">{{ $title }} is laundry website that helps our customer to keep track of their laundry. Our website also provide fast and efficient result, making it easier for our customer to track their laundry. This website's purpose is to fulfill our final assignment in Psychology and Design Thinking Subject.</p>
        </div>
    </div>
</div>
@endsection

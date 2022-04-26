@extends('layouts.base')

@section('title', ' - Contact')

@section('content')
<!-- Hero Sections -->
<div class="main" style="padding-top: 80px;">
    <div class="main_container">
        <div class="main_img-container" style="margin-right: 3rem;">
            <img src="{{ asset('frontend/images/contact.svg') }}" alt="Picture 7" id="contact_img">
        </div>
        <div class="main_content">
            <h1>Laundry Management</h1>
            <h2>Contact Us</h2>
            <p>If you have any question, you can contact us!</p>
        </div>
    </div>
</div>

<div class="main"><div class="divider"></div></div>

<!-- Contact Sections -->
<div class="main">
    <div class="containers">
        <div class="main_content">
            <h1>Contact Us</h1>
            <div class="row mt-5">
                <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
                    <div class="contact_container">
                        <div class="contact_list">
                            <i class="fa-solid fa-building contact_icon"></i>
                            <span style="padding-left: 30px;">{{ $outlet->name }}</span>
                        </div>
                        <div class="contact_list">
                            <i class="fa-solid fa-phone contact_icon"></i>
                            <span>{{ $outlet->phone_num }}</span>
                        </div>
                        <div class="contact_list">
                            <i class="fa-solid fa-map-location-dot contact_icon"></i>
                            <span>{{ $outlet->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

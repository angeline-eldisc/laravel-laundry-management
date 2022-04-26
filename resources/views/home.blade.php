@extends('layouts.base')

@section('title', ' - Home')

@section('content')
<!-- Hero Sections -->
<div class="main" style="padding-top: 80px;">
    <div class="main_container">
        <div class="main_content">
            <h1>Laundry</h1>
            <h2>Management</h2>
            <p>Welcome to our website!</p>
            <a href="{{ route('about') }}">
                <button class="main_btn">
                    About Us
                </button>
            </a>
        </div>
        <div class="main_img-container">
            <img src="{{ asset('frontend/images/home.svg') }}" alt="Picture 1" id="main_img">
        </div>
    </div>
</div>

<!-- Strenghts Sections -->
<div class="main">
    <div class="main_container">
        <div class="main_img-container">
            <img src="{{ asset('frontend/images/strengths.svg') }}" alt="Picture 2" id="strengths_img" style="padding-right: 3rem;">
        </div>
        <div class="main_content">
            <h1 class="title">Our Strengths</h1>
            <div class="strengths_container">
                <div class="strengths_list">
                    <i class="fa-solid fa-circle-check strengths_icon"></i>
                    <span>Simple</span>
                </div>
                <div class="strengths_list">
                    <i class="fa-solid fa-circle-check strengths_icon"></i>
                    <span>Easy to Use</span>
                </div>
                <div class="strengths_list">
                    <i class="fa-solid fa-circle-check strengths_icon"></i>
                    <span>Fast Result</span>
                </div>
                <div class="strengths_list">
                    <i class="fa-solid fa-circle-check strengths_icon"></i>
                    <span>Perfect Results</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

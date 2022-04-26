@extends('layouts.master')

@section('title', 'Manage Outlet Profile ')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <div class="row">
                <div class="d-block col-md-12">
                    <h3 class="title-3 m-b-30 pull-left"><i class="zmdi zmdi-home"></i>Profile {{ $outlet->name }}</h3>
                    <h4 class="title-3 m-b-30 pull-right" style="font-size: 18px;">
                        <a href="{{ route('outlet.edit', $outlet->id) }}">
                            <i class="zmdi zmdi-edit"></i>Edit Profile Outlet
                        </a>
                    </h4>
                </div>
            </div>
            <div class="p-l-44 p-b-44 d-block">
                <div class="row">
                    <div class="col col-md-3">
                        <div class="img-200 pull-left p-t-10 p-b-10">
                            @if ($outlet->profile)
                                <img src="{{ asset('images/outlet/'.$outlet->profile) }}" alt="user" />
                            @else
                                <img src="{{ asset('images/default.png') }}" alt="profile_photo" />
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-9 vertical-center">
                        <h1>
                            {{ $outlet->name }}<br>
                            <form action="{{ route('outlet.deleteProfile', $outlet->id) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('POST') }}
                                <button type="submit" class="au-btn au-btn--small au-btn--red">
                                    Delete Profile
                                </button>
                            </form>
                            <button type="button" class="au-btn au-btn--small au-btn--green m-l-10" data-toggle="modal" data-target="#changeProfile">
                                Change Profile
                            </button>
                        </h1>
                    </div>
                </div>

                <div class="fs-20 p-t-20">
                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Name
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $outlet->name }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Address
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $outlet->address }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Phone Number
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $outlet->phone_num }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal Profile -->
<div class="modal fade" id="changeProfile" tabindex="-1" role="dialog" aria-labelledby="changeProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfileLabel">Change Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('outlet.updateProfile', $outlet->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row form-group">
                        <div class="col-12 col-md-12">
                            <img width="200" height="200" class="dis-block m-l-r-auto"/>
                            <input type="file" class="uploads form-control {{ $errors->has('profile') ? 'is-invalid' : '' }}" style="margin-top: 20px;" name="profile">
                            @if ($errors->has('profile'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('profile') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('outlet.index') }}" class="btn btn-secondary">Close</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

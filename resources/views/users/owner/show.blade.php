@extends('layouts.master')

@section('title', 'Manage Owner Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>Profile {{ $owner->name }}</h3>
            <div class="p-l-44 p-b-44">
                <div class="row">
                    <div class="col col-md-3">
                        <div class="img-circle-costum img-200 pull-left p-t-10 p-b-10">
                            @if ($owner->profile)
                                <img src="{{ asset('images/users/'.$owner->profile) }}" alt="user" />
                            @else
                                <img src="{{ asset('images/users/default.png') }}" alt="user" />
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-9 vertical-center">
                        <h1>
                            {{ $owner->name }}<br>
                            <form action="{{ route('users.owner.deleteProfile', $owner->id) }}" method="POST" class="float-left">
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
                            Full Name
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->name }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Gender
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->gender }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Username
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->username }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Email Address
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->email }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Phone Number
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->phone_num }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Address
                        </div>

                        <div class="col-12 col-md-9">
                            {{ $owner->address }}
                        </div>
                    </div>

                    <div class="row p-b-10">
                        <div class="col col-md-3">
                            Role
                        </div>

                        <div class="col-12 col-md-9">
                            <span class="role kasir">{{ $owner->role }}</span>
                        </div>
                    </div>

                    <br><br>

                    <div class="row text-center">
                        <div class="col col-md-12">
                            <a href="{{ route('users.owner.index') }}" class="btn btn-secondary btn-lg">Back</a>
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
                <form action="{{ route('users.owner.updateProfile', $owner->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

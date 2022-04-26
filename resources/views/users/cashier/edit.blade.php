@extends('layouts.master')

@section('title', 'Edit Cashier Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block p-5">
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>edit cashier user&nbsp;-&nbsp;{{ $cashier->name }}</h3>
                <form action="{{ route('users.cashier.update', $cashier->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                    @csrf
                    {{  method_field('PUT') }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class="form-control-label">Full Name</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $cashier->name }}">
                            @if ($errors->has('name'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('name') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class="form-control-label">Gender</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label ">
                                    <input type="radio" id="inline-radio1" name="gender" value="Male" class="form-check-input" {{ $cashier->gender == 'Male' ? 'checked' : '' }}>Male
                                </label>&nbsp;&nbsp;&nbsp;
                                <label for="inline-radio2" class="form-check-label ">
                                    <input type="radio" id="inline-radio2" name="gender" value="Female" class="form-check-input"{{ $cashier->gender == 'Female' ? 'checked' : '' }}>Female
                                </label>
                            </div>
                            @if ($errors->has('gender'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('name') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="username" class="form-control-label">Username</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" id="username" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ $cashier->username }}" disabled>
                            @if ($errors->has('username'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('username') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email" class="form-control-label">Email Address</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="text" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $cashier->email }}" disabled>
                            @if ($errors->has('email'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('email') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="phone_num" class="form-control-label">Phone Number</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="phone_num" name="phone_num" class="form-control {{ $errors->has('phone_num') ? 'is-invalid' : '' }}" value="{{ $cashier->phone_num }}">
                            @if ($errors->has('phone_num'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('phone_num') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="address" class="form-control-label">Address</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <textarea name="address" id="address" rows="4" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ $cashier->address }}</textarea>
                            @if ($errors->has('address'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('address') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="profile" class="col col-md-3 control-label">New Profile</label>
                        <div class="col-12 col-md-6">
                            <img width="200" height="200" />
                            <input type="file" class="uploads form-control" style="margin-top: 20px;" name="profile">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('users.cashier.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--green">Update</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

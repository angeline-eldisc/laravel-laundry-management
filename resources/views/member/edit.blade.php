@extends('layouts.master')

@section('title', 'Edit Member')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block p-5">
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>edit member</h3>
                <form action="{{ route('members.update', $member->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class="form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $member->name }}">
                            @if ($errors->has('name'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('name') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="address" class="form-control-label">Address</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <textarea name="address" class="form-control{{ $errors->has('address') ? 'is-invalid' : '' }}" id="textarea-input" rows="4" class="form-control">{{ $member->address }}</textarea>
                            @if ($errors->has('address'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('address') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="gender" class="form-control-label">Gender</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="col col-md-12">
                                <div class="form-check-inline form-check">
                                    <label for="inline-radio1" class="form-check-label">
                                        <input type="radio" id="inline-radio1" name="gender" value="Male" style="margin-left: -15px;" class="form-check-input" {{ $member->gender == 'Male' ? 'checked' : '' }}>Male&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="inline-radio2" class="form-check-label ">
                                        <input type="radio" id="inline-radio2" name="gender" value="Female" class="form-check-input" {{ $member->gender == 'Female' ? 'checked' : '' }}>Female
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('gender'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('gender') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="phone_num" class="form-control-label">Phone Number</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="text" id="phone_num" name="phone_num" class="form-control {{ $errors->has('phone_num') ? 'is-invalid' : '' }}" value="{{ $member->phone_num }}">
                            @if ($errors->has('phone_num'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('phone_num') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="profile" class="col col-md-3 control-label">New Profile</label>
                        <div class="col-12 col-md-6">
                            <img width="200" height="200" />
                            <input type="file" class="uploads form-control {{ $errors->has('profile') ? 'is-invalid' : '' }}" style="margin-top: 20px;" name="profile">
                            @if ($errors->has('profile'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('profile') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--blue">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

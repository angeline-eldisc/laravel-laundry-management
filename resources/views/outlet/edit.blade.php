@extends('layouts.master')

@section('title', 'Edit Profile Outlet')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block p-5">
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>edit profile outlet</h3>
                <form action="{{ route('outlet.update', $outlet->id) }}" method="post" class="form-horizontal" autocomplete="off">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class="form-control-label">Laundry Name</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $outlet->name }}">
                            @if ($errors->has('name'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('name') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="phone_num" class="form-control-label">Phone Number</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="phone_num" name="phone_num" class="form-control {{ $errors->has('phone_num') ? 'is-invalid' : '' }}" value="{{ $outlet->phone_num }}">
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
                            <textarea name="address" class="form-control{{ $errors->has('address') ? 'is-invalid' : '' }}" id="textarea-input" rows="4" class="form-control">{{ $outlet->address }}</textarea>
                            @if ($errors->has('address'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('address') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('outlet.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--blue">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

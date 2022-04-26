@extends('layouts.master')

@section('title', 'Reset Password')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block p-5">
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-settings"></i>Reset Password</h3>
                <form action="{{ route('users.reset', Auth::user()->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password" class="form-control-label">Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('password') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col col-md-3">
                            <label for="password-confirm" class="form-control-label">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="col-12 col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('users.admin.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--blue">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

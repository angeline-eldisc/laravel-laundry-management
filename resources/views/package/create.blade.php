@extends('layouts.master')

@section('title', 'Add Package')

@section('css')
<style>
    .select2-selection__rendered {
        line-height: calc(2.25rem + 2px) !important;
    }
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
    }
    .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body card-block p-5">
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>add package</h3>
                <form action="{{ route('packages.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="type" class="form-control-label">Type</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <select name="type" id="select2_type" class="select2_type form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" value="{{ old('type') }}">
                                <option></option>
                                <option value="Kiloan" {{ old('type') == 'Kiloan' ? 'selected' : '' }}>Kiloan</option>
                                <option value="Blanket" {{ old('type') == 'Blanket' ? 'selected' : '' }}>Blanket</option>
                                <option value="Bed Cover" {{ old('type') == 'Bed Cover' ? 'selected' : '' }}>Bed Cover</option>
                                <option value="Shirt" {{ old('type') == 'Shirt' ? 'selected' : '' }}>Shirt</option>
                                <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->has('type'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('type') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="package_name" class="form-control-label">Package Name</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" id="package_name" name="package_name" class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" value="{{ old('package_name') }}">
                            @if ($errors->has('package_name'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('package_name') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="price" class="form-control-label">Price</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" id="price" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('price') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--blue">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

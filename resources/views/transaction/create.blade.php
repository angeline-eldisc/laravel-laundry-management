@extends('layouts.master')

@section('title', 'Add TRansaction')

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
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>add transaction</h3>
                <form action="{{ route('transactions.store') }}" method="post" class="form-horizontal" autocomplete="off">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="invoice_code" class="form-control-label">Invoice Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" id="invoice_code" name="invoice_code" class="form-control {{ $errors->has('invoice_code') ? 'is-invalid' : '' }}" value="{{ $code }}" readonly="">
                            @if ($errors->has('invoice_code'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('invoice_code') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="member_id" class="form-control-label">Member</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <select name="member_id" id="select2_member_id" class="select2_member_id form-control {{ $errors->has('member_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('member_id'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('member_id') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="date" class="form-control-label">Transaction Date</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="datetime-local" id="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('date') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="due_date" class="form-control-label">Due Date</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="date" id="due_date" name="due_date" class="form-control {{ $errors->has('due_date') ? 'is-invalid' : '' }}" value="{{ old('due_date') }}">
                            @if ($errors->has('due_date'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('due_date') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="package_id" class="form-control-label">Package</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <select name="package_id" id="select2_package_id" class="select2_package_id form-control {{ $errors->has('package_id') ? 'is-invalid' : '' }}">
                                <option></option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>[{{ $package->type }}]&nbsp;{{ $package->package_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('package_id'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('package_id') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="qty" class="form-control-label">Quantity</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="qty" name="qty" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" value="{{ old('qty') }}">
                            @if ($errors->has('qty'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('qty') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="additional_cost" class="form-control-label">Additional Cost</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" id="additional_cost" name="additional_cost" class="form-control {{ $errors->has('additional_cost') ? 'is-invalid' : '' }}" value="{{ old('additional_cost') }}">
                            @if ($errors->has('additional_cost'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('additional_cost') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="discount" class="form-control-label">Discount (%)</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="discount" name="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" value="{{ old('discount') }}">
                            @if ($errors->has('discount'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('discount') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tax" class="form-control-label">Tax (%)</label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="tax" name="tax" class="form-control {{ $errors->has('tax') ? 'is-invalid' : '' }}" value="{{ old('tax') }}">
                            @if ($errors->has('tax'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('tax') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="payment_date" class="form-control-label">Payment Date</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <input type="date" id="payment_date" name="payment_date" class="form-control mb-1 {{ $errors->has('payment_date') ? 'is-invalid' : '' }}" value="{{ old('payment_date') }}">
                            <span style="font-size: 12px;">Note: Payment date can be skipped if paid status is 'Not Yet Paid'.</span>
                            @if ($errors->has('payment_date'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('payment_date') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="paid_status" class="form-control-label">Paid Status</label>
                        </div>
                        <div class="col-12 col-md-5">
                            <select name="paid_status" id="select2_paid_status" class="select2_paid_status form-control {{ $errors->has('paid_status') ? 'is-invalid' : '' }}">
                                <option></option>
                                <option value="Paid" {{ old('paid_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Not yet paid" {{ old('paid_status') == 'Not yet paid' ? 'selected' : '' }}>Not yet paid</option>
                            </select>
                            @if ($errors->has('paid_status'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('paid_status') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="description" class="form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <textarea name="description" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" id="textarea-input" rows="4" class="form-control">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('description') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="au-btn au-btn--small au-btn--blue">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')

@section('title', 'Edit Transaction')

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
                <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>edit transaction</h3>
                <form action="{{ route('transactions.update', $transaction->id) }}" method="post" class="form-horizontal" autocomplete="off">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="invoice_code" class="form-control-label">Invoice Code</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" id="invoice_code" name="invoice_code" class="form-control {{ $errors->has('invoice_code') ? 'is-invalid' : '' }}" value="{{ $transaction->invoice_code }}" readonly="">
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
                                    <option value="{{ $member->id }}" {{ $member->id == $transaction->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
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
                            <label for="additional_cost" class="form-control-label">Additional Cost</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="text" id="additional_cost" name="additional_cost" class="form-control {{ $errors->has('additional_cost') ? 'is-invalid' : '' }}" value="{{ $transaction->additional_cost }}">
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
                        <div class="col-12 col-md-2">
                            <input type="text" id="discount" name="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" value="{{ $transaction->discount }}">
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
                        <div class="col-12 col-md-2">
                            <input type="text" id="tax" name="tax" class="form-control {{ $errors->has('tax') ? 'is-invalid' : '' }}" value="{{ $transaction->tax }}">
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
                            <input type="datetime" id="payment_date" name="payment_date" class="form-control mb-1 {{ $errors->has('payment_date') ? 'is-invalid' : '' }}" value="{{ $transaction->payment_date }}">
                            <span style="font-size: 12px;">Note: Payment date can be skipped if paid status
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
                        <div class="col-12 col-md-4">
                            <select name="paid_status" id="select2_paid_status" class="select2_paid_status form-control {{ $errors->has('paid_status') ? 'is-invalid' : '' }}" value="{{ $transaction->paid_status }}">
                                <option></option>
                                <option value="Paid" {{ $transaction->paid_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Not yet paid" {{ $transaction->paid_status == 'Not yet paid' ? 'selected' : '' }}>Not yet paid</option>
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
                            <label for="status" class="form-control-label">Status</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <select name="status" id="select2_status" class="select2_status form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" value="{{ old('status') }}">
                                <option></option>
                                <option value="New" {{ $transaction->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Process" {{ $transaction->status == 'Process' ? 'selected' : '' }}>Process</option>
                                <option value="Pick Up" {{ $transaction->status == 'Pick Up' ? 'selected' : '' }}>Pick Up</option>
                                <option value="Done" {{ $transaction->status == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                            @if ($errors->has('status'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('status') }}
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

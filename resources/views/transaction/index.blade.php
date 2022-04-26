@extends('layouts.master')

@section('title', 'Manage Transaction')

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
        <h3 class="title-5 m-b-25">transaction data table</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <a href="{{ route('transactions.create') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add transaction
                </a>
            </div>
            <div class="table-data__tool-right">
                Total Transaction&nbsp;&nbsp;:&nbsp;&nbsp;{{ $transactions->count() }}&nbsp;&nbsp;Data
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>kode</th>
                        <th>transaction date</th>
                        <th>pay status</th>
                        <th>member</th>
                        <th>status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactions->count() > 0)
                        @foreach ($transactions as $transaction)
                            <tr class="tr-shadow">
                                <td>{{ $transaction->invoice_code }}</td>
                                <td>{{ $transaction->date }}</td>
                                <td>
                                    @if ($transaction->paid_status == 'Paid')
                                        <span class="status--process">Paid</span>
                                    @else
                                        <span class="status--denied">Not yet Paid</span>
                                    @endif
                                </td>
                                <td>{{ $transaction->member->name }}</td>
                                <td>
                                    @if( $transaction->status == 'New')
                                        <span class="badge badge-info" style="font-size:12px!important;">{{ $transaction->status }}</span>
                                    @elseif( $transaction->status == 'Process')
                                        <span class="badge badge-warning" style="font-size:12px!important;">{{ $transaction->status }}</span>
                                    @elseif( $transaction->status == 'Done')
                                        <span class="badge badge-success" style="font-size:12px!important;">{{ $transaction->status }}</span>
                                    @else
                                        <span class="badge badge-secondary" style="font-size:12px!important;">{{ $transaction->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <button type="button" class="item addItemPackage" data-placement="top" title="" data-original-title="Add Package" data-toggle="modal" data-target="#addPackage" data-id="{{ $transaction->invoice_code }}" id="addItemPackage">
                                            <i class="zmdi zmdi-plus"></i>
                                          </button>
                                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure? You will not be able to revert this!');">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                        &nbsp;
                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail">
                                            <i class="zmdi zmdi-more"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="7">No Records Found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="addPackageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPackageLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transactions.addPackageItem') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="qty" class="form-control-label">Invoice Code</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <input type="text" name="invoice_code" id="transactionCode" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="package_id" class="form-control-label">Package</label>
                        </div>
                        <div class="col-12 col-md-12">
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
                        <div class="col col-md-12">
                            <label for="qty" class="form-control-label">Quantity</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" id="qty" name="qty" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" value="{{ old('qty') }}">
                            @if ($errors->has('qty'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('qty') }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-12">
                            <label for="description" class="form-control-label">Description</label>
                        </div>
                        <div class="col-12 col-md-12">
                            <textarea name="description" class="form-control{{ $errors->has('description') ? 'is-invalid' : '' }}" id="textarea-input" rows="4" class="form-control">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <small class="form-text" style="color: red">
                                    {{ $errors->first('description') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="au-btn au-btn--small au-btn--blue">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).on("click", "#addItemPackage", function () {
        var id = $(this).data('id');
        $("#addPackageLabel").text("Add Package Item - " + id);
        $("#transactionCode").val(id);
    });
</script>
@endsection

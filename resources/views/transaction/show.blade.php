@extends('layouts.master')

@section('title', 'Show Transaction')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>Detail Transaction</h3>
            <div class="p-l-44 p-b-44" style="padding: 0 44px 44px 44px;">
                <div class="fs-18">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Invoice Code</th>
                                    <td>{{ $transaction->invoice_code }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Transaction Date</th>
                                    <td>{{ $transaction->date }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Full Name</th>
                                    <td>{{ $transaction->member->name }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Address</th>
                                    <td>{{ $transaction->member->address }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Phone Number</th>
                                    <td>{{ $transaction->member->phone_num }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Status Order</th>
                                    <td>{{ $transaction->status }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Paid Status</th>
                                    <td>{{ $transaction->paid_status }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" width="40%">Pick Up Date</th>
                                    <td>{{ $transaction->due_date }}</td>
                                </tr>
                            </table>

                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <th width="5%">No</th>
                                    <th>Package</th>
                                    <th width="20%" colspan="2">Price</th>
                                    <th class="text-center" width="10%">Quantity</th>
                                    <th width="20%" colspan="2">Subtotal</th>
                                    <th width="6%"></th>
                                </thead>
                                <tbody>
                                    @if($transaction->count() > 0)
                                        @foreach ($transaction->packages as $data)
                                            <?php
                                                $totalAll = $data->pivot->sum('total');
                                                $discount = $totalAll * $transaction->discount/100;
                                                $tax = $totalAll * $transaction->tax/100;
                                                $totalAllPrice = $totalAll + $transaction->additional_cost + $tax - $discount;
                                            ?>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $data->package_name }}
                                                    <br>
                                                    <span class="fs-14">(Note: {{ $data->pivot->description }})</span>
                                                </td>
                                                <td style="border-right-style: hidden;" width="5%">Rp</td>
                                                <td class="text-right">{{ number_format($data->price, 0, "", ".") }}</td>
                                                <td class="text-center">{{ $data->pivot->qty }}</td>
                                                <td style="border-right-style: hidden;" width="5%">Rp</td>
                                                <td class="text-right">{{ number_format($data->pivot->total, 0, "", ".") }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('transactions.editPackageItem', $data->pivot->id) }}" class="btn btn-success float-left btn-sm ml-2">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a> --}}
                                                    <form action="{{ route('transactions.deletePackageItem', $data->pivot->id) }}" method="POST" class="float-left ml-1">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure? You will not be able to revert this!');">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="text-right">
                                                Total
                                            </td>
                                            <td style="border-right-style: hidden;" width="5%"><strong>Rp</st></td>
                                            <td class="text-right"><strong>{{ number_format($totalAllPrice, 0, "", ".") }}</st></td>
                                            <td></td>
                                        </tr>
                                        <tr style="border-right: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;">
                                            <td colspan="7" style="text-align: right;">
                                                <span style="font-size: 12px; text-align: right;">*includes tax and discount</span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Record Found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br>

                    <div class="row text-center">
                        <div class="col col-md-12">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-lg">Back</a>
                            <a href="{{ route('transactions.printInvoice', $transaction->id) }}" target="_blank" class="btn btn-info btn-lg">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

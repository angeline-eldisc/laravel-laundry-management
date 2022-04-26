@extends('layouts.base')

@section('title', ' - About')

@section('content')
<!-- Hero Sections -->
<div class="main" style="padding-top: 80px;">
    <div class="main_container">
        <div class="main_content left-content">
            <h1>Laundry Management</h1>
            <h2>Track Your Laundry</h2>
            <p>Track your laundry in here.</p>
        </div>
        <div class="main_img-container">
            <img src="{{ asset('frontend/images/trackLaundry.svg') }}" alt="Picture 3" id="about_img">
        </div>
    </div>
</div>

<div class="main"><div class="divider"></div></div>

<!-- About Sections -->
<div class="main">
    <div class="containers">
        <div class="main_content">
            <h1>Input Invoice Code</h1>
            <p class="paragraph">Input your invoice code down below. <br>Please do not worry, this is only for searching.</p>

            <form action="{{ route('track.laundry') }}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-lg-6 col-md-8 mb-4 mx-auto">
                        <input type="text" class="form-control form-control-lg" name="invoice_code" id="invoice_code" required>
                    </div>
                </div>

                <div class="row">
                    <div style="text-align: center;">
                        <button class="btn btn-green col-lg-4 col-md-6 mb-4 mt-2" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main" id="result"><div class="divider"></div></div>

<div class="main">
    <div class="containers">
        <div class="main_content">
            <h2>Your Result</h2>
            <p class="paragraph">Based on your input, this is what we got.</p>

            @if($transaction != NULL)
            <div class="row">
                <div class="col-md-10" style="margin-left: auto; margin-right: auto;">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Invoice Code</th>
                                <td style="text-align: left;">{{ $transaction->invoice_code }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Transaction Date</th>
                                <td style="text-align: left;">{{ $transaction->date }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Full Name</th>
                                <td style="text-align: left;">{{ $transaction->member->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Address</th>
                                <td style="text-align: left;">{{ $transaction->member->address }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Phone Number</th>
                                <td style="text-align: left;">{{ $transaction->member->phone_num }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Status Order</th>
                                <td style="text-align: left;">{{ $transaction->status }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Paid Status</th>
                                <td style="text-align: left;">{{ $transaction->paid_status }}</td>
                            </tr>
                            <tr>
                                <th class="bg-primary text-white" width="40%" style="text-align: left;">Pick Up Date</th>
                                <td style="text-align: left;">{{ $transaction->due_date }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <th width="5%">No</th>
                                <th style="text-align: left;">Package</th>
                                <th width="20%" colspan="2">Price</th>
                                <th style="text-align: center;" width="10%">Quantity</th>
                                <th width="20%" colspan="2">Subtotal</th>
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
                                            <td style="text-align: left;">
                                                {{ $data->package_name }}
                                                <br>
                                                <span class="fs-14">(Note: {{ $data->pivot->description }})</span>
                                            </td>
                                            <td style="border-right-style: hidden;" width="5%">Rp</td>
                                            <td style="text-align: right;">{{ number_format($data->price, 0, "", ".") }}</td>
                                            <td style="text-align: center;">{{ $data->pivot->qty }}</td>
                                            <td style="border-right-style: hidden;" width="5%">Rp</td>
                                            <td style="text-align: right;">{{ number_format($data->pivot->total, 0, "", ".") }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: right;">
                                            Total
                                        </td>
                                        <td style="border-right-style: hidden;" width="5%"><strong>Rp</st></td>
                                        <td style="text-align: right;"><strong>{{ number_format($totalAllPrice, 0, "", ".") }}</strong></td>
                                    </tr>
                                    <tr style="border-right: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent;">
                                        <td colspan="7" style="text-align: right;">
                                            <span style="font-size: 12px; text-align: right;">*includes tax and discount</span>
                                        </td>
                                    </tr>
                                @else
                                <tr>
                                    <td colspan="9" style="text-align: center;">No Record Found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-10" style="margin-left: auto; margin-right: auto;">
                    <p class="paragraph" style="border: 1px solid black">
                        No Order Found
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="main"><div class="divider"></div></div>
<div class="main"><div class="divider"></div></div>
<div class="main"><div class="divider"></div></div>
<div class="main"><div class="divider"></div></div>
@endsection

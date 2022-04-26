<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo "print-invoice_".date('Y-m-d_H-i-s'); ?></title>
    <style>
        * {
            font-family: 'Helvetica', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%!important;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .title {
            display: block;
            margin-bottom: 75px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }

        .outlet-contactInfo {
            display: block;
            width: 40%;
            margin-bottom: 30px;
        }

        .briefInfo {
            border-top: 5px solid black;
            margin-bottom: 175px;
        }

        .m-t-30 {
            margin-top: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%!important;
            margin-left: auto!important;
            margin-right: auto!impmargin-left: auto!important;
        }

        .title-table {
            vertical-align: top;
            padding-left: 5px;
        }

        .numberColumn {
            width: 30px;
        }

        table.customerInfo th, table.customerInfo td {
            text-align: left;
        }

        table.customerInfo th {
            padding-right: 20px;
        }

        table.customerInfo td{
            min-width: auto;
            max-width: 300px;
        }

        table.transactionInfo th{
            text-align: right;
        }

        table.transactionInfo td {
            text-align: left;
            padding-right: 5px;
        }

        table.transactionInfo th {
            padding-right: 20px;
        }

        .packageTable {
            display: block;
        }

        table.package-itemTable {
            width: 100%;
        }

        table.package-itemTable th, table.package-itemTable td {
            border: 0.1px solid;
            padding: 7px 15px;
        }

        td.currencyColumn {
            border-right: 0.1px solid transparent;
        }

        .description-info {
            margin-top: 50px;
        }

        .border-left-none {
            border-left: 0px solid transparent;
        }

        .border-right-none {
            border-right: 0px solid transparent;
        }

        .border-bottom-none {
            border-bottom: 0px solid transparent;
        }

        .border-top-none {
            border-top: 0px solid transparent;
        }

        .border-bottom-thick {
            border-bottom: 2px solid black!important;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1 class="f-right"><strong>Invoice</strong></h1>
        <h1 class="f-left">{{ $outlet->name }}</h1>
    </div>

    <div class="outlet-contactInfo">
        <p>{{ $outlet->address }}</p>
        <p>Phone Number: {{ $outlet->phone_num }}</p>
    </div>

    <div class="briefInfo">
        <div class="f-left m-t-30">
            <table class="customerInfo">
                <tr>
                    <th rowspan="3" class="title-table">Customer</th>
                    <td>{{ $transaction->member->name }}</td>
                </tr>
                <tr>
                    <td>{{ $transaction->member->address }}</td>
                </tr>
                <tr>
                    <td>Phone Number: {{ $transaction->member->phone_num }}</td>
                </tr>
            </table>
        </div>
        <div class="f-right m-t-30">
            <table class="transactionInfo">
                <tr>
                    <th>Invoice Code</th>
                    <td>{{ $transaction->invoice_code }}</td>
                </tr>
                <tr>
                    <th>Transaction Date</th>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaction->date)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Pick Up Date</th>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $transaction->due_date)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="packageTable">
        <table class="package-itemTable">
            <tr>
                <th class="numberColumn">No.</th>
                <th class="left">Package</th>
                <th colspan="2">Price</th>
                <th>Quantity</th>
                <th colspan="2">Subtotal</th>
            </tr>
            @if($transaction->count() > 0)
                @foreach ($transaction->packages as $data)
                <?php
                    $totalAll = $data->pivot->sum('total');
                    $discount = $totalAll * $transaction->discount/100;
                    $tax = $totalAll * $transaction->tax/100;
                    $totalAllPrice = $totalAll + $transaction->additional_cost + $tax - $discount;
                ?>
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>
                        {{ $data->package_name }}
                        <br>
                        <span>(Note: {{ $data->pivot->description }})</span>
                    </td>
                    <td class="currencyColumn">Rp</td>
                    <td class="right">{{ number_format($data->price, 0, "", ".") }}</td>
                    <td class="center quntitiesColumn">{{ $data->pivot->qty }}</td>
                    <td class="currencyColumn">Rp</td>
                    <td class="right">{{ number_format($data->pivot->total, 0, "", ".") }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="border-left-none border-right-none border-bottom-none"></td>
                    <td class="border-left-none border-right-none border-bottom-none"></td>
                    <td class="border-left-none border-right-none border-bottom-none"></td>
                    <td class="border-left-none border-right-none border-bottom-none"></td>
                    <td class="border-right-none border-bottom-thick center">
                        <strong>
                            Total
                        </strong>
                    </td>
                    <td class="currencyColumn border-left-none border-bottom-thick"><strong>Rp</strong></td>
                    <td class="right border-right-none border-bottom-thick"><strong>{{ number_format($totalAllPrice, 0, "", ".") }}</strong></td>
                </tr>
                <tr>
                    <td class="border-left-none border-right-none border-bottom-none" colspan="5"></td>
                    <td colspan="2" class="border-right-none border-bottom-none right" style="padding-right: 0px;">
                        <span style="font-size: 12px">*includes tax and discount</span>
                    </td>
                </tr>
            @else
            <tr>
                <td colspan="9" class="text-center">No Record Found.</td>
            </tr>
            @endif
        </table>
    </div>
    <div class="description-info">
        <b>Description :<br></b>
        1. When picking up the laundry, you must bring an invoice.<br>
        2. Discolored laundry is not our responsibility.<br>
        3. Calculate and check before leaving.<br>
        4. Claims for lost laundry after leaving the laundry are not served.<br>
        5. We cannot replace laundry which is damaged/shrunk due to the nature of the fabric.<br>
        6. Laundry that is not picked up for more than 1 month is not our responsibility.<br>
    </div>
</body>
</html>

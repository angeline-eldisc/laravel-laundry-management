{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<h2 class="title-1">Dashboard</h2>
<div class="row m-t-10">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $user->count() }}</h2>
            <span class="desc">total users</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $transaction->count() }}</h2>
            <span class="desc">total transaction</span>
            <div class="icon">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $member->count() }}</h2>
            <span class="desc">total member</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $package->count() }}</h2>
            <span class="desc">total package</span>
            <div class="icon">
                <i class="zmdi zmdi-calendar-note"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="fas fa-exchange-alt"></i>Waiting for Order to be Picked Up</h3>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>code</td>
                            <td>date</td>
                            <td>paid status</td>
                            <td>member</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($acceptedTransactions->count() > 0)
                            @foreach ($acceptedTransactions as $accepted)
                                <tr>
                                    <td>{{ $accepted->invoice_code }}</td>
                                    <td>{{ $accepted->date }}</td>
                                    <td>
                                        @if ($accepted->paid_status == 'Paid')
                                            <span class="status--process">Paid</span>
                                        @else
                                            <span class="status--denied">Not yet paid</span>
                                        @endif
                                    </td>
                                    <td>{{ $accepted->member->name }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('transactions.index') }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No Records Found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="fas fa-exchange-alt"></i>New Order</h3>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>code</td>
                            <td>paid status</td>
                            <td>member</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($newTransactions->count() > 0)
                            @foreach ($newTransactions as $new)
                                <tr>
                                    <td>{{ $new->invoice_code }}</td>
                                    <td>
                                        @if ($new->paid_status == 'Paid')
                                            <span class="status--process">Paid</span>
                                        @else
                                            <span class="status--denied">Not yet paid</span>
                                        @endif
                                    </td>
                                    <td>{{ $new->member->name }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('transactions.index') }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No Records Found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="fas fa-exchange-alt"></i>Process Order</h3>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>code</td>
                            <td>paid status</td>
                            <td>member</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($processTransactions->count() > 0)
                            @foreach ($processTransactions as $process)
                                <tr>
                                    <td>{{ $process->invoice_code }}</td>
                                    <td>
                                        @if ($process->paid_status == 'Paid')
                                            <span class="status--process">Paid</span>
                                        @else
                                            <span class="status--denied">Not yet paid</span>
                                        @endif
                                    </td>
                                    <td>{{ $process->member->name }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('transactions.index') }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No Records Found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

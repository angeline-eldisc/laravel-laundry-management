@extends('layouts.master')

@section('title', 'Laporan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-swap"></i>transactions report<br><br>
                <a href="{{ route('reports.excel.transaction') }}" class="au-btn au-btn--small" style="background-color:rgb(42, 165, 176)">
                    Export All Excel Transactions Report
                </a>
            </h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-accounts-alt"></i>users report<br><br>
                <a href="{{ route('reports.excel.users.admin') }}" class="au-btn au-btn--small au-btn--red">
                    Export All Excel Admin Users Report
                </a>
                <a href="{{ route('reports.excel.users.cashier') }}" class="au-btn au-btn--small" style="background-color:rgb(225, 175, 57)">
                    Export All Excel Cashier Users Report
                </a>
                <a href="{{ route('reports.excel.users.owner') }}" class="au-btn au-btn--small au-btn--green">
                    Export All Excel Owner Users Report
                </a>
            </h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-card-membership"></i>members report<br><br>
                <a href="{{ route('reports.excel.member') }}" class="au-btn au-btn--small" style="background-color: rgb(118, 42, 176)">
                    Export All Excel Members Report
                </a>
            </h3>
        </div>
    </div>
</div>
@endsection

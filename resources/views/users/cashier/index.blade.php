@extends('layouts.master')

@section('title', 'Manage Cashier Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>cashier users<br><br>
                <a href="{{ route('users.cashier.create') }}" class="au-btn au-btn--small au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>Add Cashier User
                </a>
            </h3>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>no.</td>
                            <td></td>
                            <td style="padding-left: 20px;">nama</td>
                            <td>gender</td>
                            <td>username</td>
                            <td>phone number</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cashiers->count() > 0)
                            @foreach ($cashiers as $cashier)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-right" width="10" style="padding-right: 0px;">
                                    <div class="img-circle-costum img-45 pull-left">
                                        @if ($cashier->profile)
                                            <img src="{{ asset('images/users/'.$cashier->profile) }}" alt="user" class="h-100"/>
                                        @else
                                            <img src="{{ asset('images/default.png') }}" alt="user" class="h-100"/>
                                        @endif
                                    </div>
                                </td>
                                <td style="padding-left: 20px;">
                                    <div class="table-data__info">
                                        <h6>{{ $cashier->name }}</h6>
                                        <span>
                                            <a href="mailto:{{ $cashier->email }}">{{ $cashier->email }}</a>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    {{ $cashier->gender }}
                                </td>
                                <td>
                                    {{ $cashier->username }}
                                </td>
                                <td>
                                    <span class="block-email">{{ $cashier->phone_num }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('users.cashier.destroy', $cashier->id) }}" method="POST" class="float-left">
                                        <span class="more">
                                            <a href="{{ route('users.cashier.edit', $cashier->id) }}">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </span>
                                        <span class="more">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('Are you sure? You will not be able to revert this!');">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </span>
                                        <span class="more">
                                            <a href="{{ route('users.cashier.show', $cashier->id) }}">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                        </span>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">No Records Found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

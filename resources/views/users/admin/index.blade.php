@extends('layouts.master')

@section('title', 'Manage Admin Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>admin users<br><br>
                <a href="{{ route('users.admin.create') }}" class="au-btn au-btn--small au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>Add Admin User
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
                        @if ($admins->count() > 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-right" width="10" style="padding-right: 0px;">
                                        <div class="img-circle-costum img-45 pull-left">
                                            @if ($admin->profile)
                                                <img src="{{ asset('images/users/'.$admin->profile) }}" alt="user" class="h-100"/>
                                            @else
                                                <img src="{{ asset('images/default.png') }}" alt="user" class="h-100"/>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding-left: 20px;">
                                        <div class="table-data__info">
                                            <h6>{{ $admin->name }}</h6>
                                            <span>
                                                <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $admin->gender }}
                                    </td>
                                    <td>
                                        {{ $admin->username }}
                                    </td>
                                    <td>
                                        <span class="block-email">{{ $admin->phone_num }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.admin.destroy', $admin->id) }}" method="POST" class="float-left">
                                            <span class="more">
                                                <a href="{{ route('users.admin.edit', $admin->id) }}">
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
                                                <a href="{{ route('users.admin.show', $admin->id) }}">
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

@extends('layouts.master')

@section('title', 'Manage Members')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="user-data m-b-30">
            <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>members
                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                <br><br>
                <a href="{{ route('members.create') }}" class="au-btn au-btn--small au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>Add member
                </a>
                @endif
            </h3>
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>no.</td>
                            <td>name</td>
                            <td>gender</td>
                            <td>phone number</td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                            <td></td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($members->count() > 0)
                            @foreach ($members as $member)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="img-circle-costum pull-left">
                                            @if ($member->profile)
                                                <img src="{{ asset('images/users/'.$member->profile) }}" width="45" alt="user" class="h-100"/>
                                            @else
                                                <img src="{{ asset('images/default.png') }}" width="45" alt="user" class="h-100"/>
                                            @endif
                                        </div>
                                        {{ $member->name }}
                                    </td>
                                    <td>
                                        {{ $member->gender }}
                                    </td>
                                    <td>
                                        <span class="block-email">{{ $member->phone_num }}</span>
                                    </td>
                                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                                    <td>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="float-left">
                                            <span class="more">
                                                <a href="{{ route('members.edit', $member->id) }}">
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
                                                <a href="{{ route('members.show', $member->id) }}">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                            </span>
                                        </form>
                                    </td>
                                    @endif
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

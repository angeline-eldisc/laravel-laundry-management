@extends('layouts.master')

@section('title', 'Manage Package')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="title-5 m-b-25">package data table</h3>
        <div class="table-data__tool">
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
            <div class="table-data__tool-left">
                <a href="{{ route('packages.create') }}" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add package
                </a>
            </div>
            <div class="table-data__tool-right">
                Total Package&nbsp;&nbsp;:&nbsp;&nbsp;{{ $packages->count() }}&nbsp;&nbsp;Data
            </div>
            @else
            <div class="table-data__tool-left">
                Total Package&nbsp;&nbsp;:&nbsp;&nbsp;{{ $packages->count() }}&nbsp;&nbsp;Data
            </div>
            @endif
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Type</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ($packages->count() > 0)
                        @foreach ($packages as $package)
                            <tr class="tr-shadow">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $package->type }}</td>
                                <td>{{ $package->package_name }}</td>
                                <td>
                                    <span class="block-email">Rp {{ $package->price }}</span>
                                </td>
                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('packages.edit', $package->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure? You will not be able to revert this!');">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            <tr class="spacer"></tr>
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
@endsection

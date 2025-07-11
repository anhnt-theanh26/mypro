@extends('layouts.admin')

@push('push_css')
    @parent
@endpush

@section('sidebar')
    @include('category::sidebar')
@endsection

@section('content')
    @yield('content-child')
@endsection

@push('push_js')
    @parent
@endpush

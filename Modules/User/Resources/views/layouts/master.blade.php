@extends('layouts.admin')

@push('push_css')
@endpush

@section('content')
    @yield('content-child')
@endsection

@push('push_js')
@endpush

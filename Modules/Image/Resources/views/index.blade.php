@extends('image::layouts.master')

@section('title', 'Images')

@push('push_css')
@endpush

@section('content-child')
    {{-- <iframe src="{{ url('admin/laravel-filemanager') }}" style="width: 100%; height: 700px; border: none;"></iframe> --}}
    <iframe src="{{ url('/laravel-filemanager') }}" style="width: 100%; height: 700px; border: none;"></iframe>
@endsection

@push('push_js')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush

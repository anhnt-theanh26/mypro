@extends('product::layouts.master')

@section('title', 'Thêm mới danh mục')

@push('push_css')
@endpush

@section('content-child')
    <form action="">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Tên </h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tên...">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                    </div>
                </div>

                <!-- Range -->
                <div class="card mb-4">
                    <h5 class="card-header">Range</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formRange1" class="form-label">Example range</label>
                            <input type="range" class="form-range" id="formRange1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Switches</h5>
                    <div class="card-body">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox
                                input</label>
                        </div>
                    </div>
                </div>

                <!-- Range -->
                <div class="card mb-4">
                    <h5 class="card-header">Range</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formRange1" class="form-label">Example range</label>
                            <input type="range" class="form-range" id="formRange1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('push_js')
@endpush

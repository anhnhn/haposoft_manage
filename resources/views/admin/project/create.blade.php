@extends('layouts.admin.master')
@section('title', ' Projects')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Project</h3>
                        </div>
                        <form role="form" class="form-horizontal" method="POST" action="{{ route('projects.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="Enter name" value="{{old('name')}}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="start_date">Start Date</label>
                                        <input type="date"
                                               class="form-control @error('start_date') is-invalid @enderror"
                                               id="startDate" name="start_date" value="{{old('start_date')}}">
                                        @error('start_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="end_date">End Date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                               id="endDate" name="end_date" value="{{old('end_date')}}">
                                        @error('end_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6 ">
                                        <label for="customer">Customer</label>
                                        <select class="form-control @error('customer_id') is-invalid @enderror"
                                                name="customer_id">
                                            <option value="-1" disabled selected>Choose your option</option>
                                            <option value="" selected>No Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
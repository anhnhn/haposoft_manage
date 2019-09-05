@extends('layouts.admin.master')
@section('title', ' Update Projects')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Project</h3>
                        </div>
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('projects.update', $project->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $project->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="birth_day">Start Date</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="startDate" name="start_date" value="{{ $project->start_date }}">
                                    @error('start_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="endDate" name="end_date" value="{{ $project->end_date }}">
                                    @error('end_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="customer">Customer</label>
                                    <select class="form-control col-xs-10 @error('customer_id') is-invalid @enderror" name="customer_id" id="customer">
                                        <option value="" disabled selected>Choose your option</option>
                                        @foreach($customers as $customer)
                                            @if($project->customer_id == $customer->id)
                                                <option value="{{ $customer->id }}"  selected>{{ $customer->name }}</option>
                                            @else
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
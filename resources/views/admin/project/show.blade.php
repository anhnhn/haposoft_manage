@extends('layouts.admin.master')
@section('title', ' Information projects')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Information Project
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box box-primary set-padding">
                    <div class="d-flex col-xs-10">
                        <div class="col-xs-8 ">
                            <form>
                                <div class="form-group d-flex">
                                    <label for="name" class="col-xs-3 col-form-label">Name</label>
                                    <div class="col-xs-10">
                                        <label type="text" readonly class="form-control" >
                                            {{ $project->name }}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="birth_day" class="col-xs-3 col-form-label">Start Date</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $project->start_date }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="address" class="col-xs-3 col-form-label">End Date</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $project->end_date }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="phone" class="col-xs-3 col-form-label">Customer</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $project->customer['name'] }}'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn-primary btn" role="button" title="Back">back</a>
            </div>
        </section>
    </div>
@endsection
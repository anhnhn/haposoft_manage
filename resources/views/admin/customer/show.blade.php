@extends('layouts.admin.master')
@section('title', ' Profile Customers')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Profile Customer
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box box-primary set-padding">
                    <div class="d-flex col-xs-10">
                        <div class="col-xs-4 avatar-mycss box-footer">
                            <h2 class="p-3">{{ $customer->name }}</h2>
                        </div>
                        <div class="col-xs-8 ">
                            <form>
                                <div class="form-group d-flex">
                                    <label for="email" class="col-xs-3 col-form-label">Email</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $customer->email }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="address" class="col-xs-3 col-form-label">Addess</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $customer->address }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="phone" class="col-xs-3 col-form-label">Phone</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $customer->phone }}'>
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
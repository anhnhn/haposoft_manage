@extends('layouts.admin.master')
@section('title', ' Profile Users')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Profile User
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box box-primary set-padding">
                    <div class="d-flex col-xs-10">
                        <div class="col-xs-4 avatar-mycss box-default">
                            <img src="{{ asset($url) }}" alt="photo" class="img-rounded">
                            <h2 class="p-3">{{ $user->name }}</h2>
                        </div>
                        <div class="col-xs-8 ">
                            <form>
                                <div class="form-group d-flex">
                                    <label for="email" class="col-xs-3 col-form-label">Email</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $user->email }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="birth_day" class="col-xs-3 col-form-label">Birth Day</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $user->birth_day }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="address" class="col-xs-3 col-form-label">Addess</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $user->address }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="phone" class="col-xs-3 col-form-label">Phone</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $user->phone }}'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
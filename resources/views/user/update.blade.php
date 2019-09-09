@extends('layouts.app')

@section('logout')
    <a class="dropdown-item" href="{{ route('users.logout') }}"
       onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('users.logout') }}" method="GET" style="display: none;">
        @csrf
    </form>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Profiles</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('user-users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{  $user->phone }}">
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="birth_day">Birth day</label>
                                        <input type="date" class="form-control @error('birth_day') is-invalid @enderror" id="birth_day" name="birth_day" value="{{ $user->birth_day }}">
                                        @error('birth_day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group border col-6">
                                        <label for="avatar">Choose avatar</label>
                                        <input type="file" id="avatar" name="avatar" value="{{ $user->avatar }}">
                                        <img id="image" src="{{ asset($url) }}" alt="your image" />
                                    </div>
                                    <input type="hidden" value="{{ $user->id }}" id="hiddenInput">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

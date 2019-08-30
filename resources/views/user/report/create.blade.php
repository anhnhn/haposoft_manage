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
                    <div class="card-header">Create Reports</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('user-reports.store') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" value="{{ old('content') }}">
                                    </textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="task">Tasks</label>
                                    <select multiple="multiple" class="form-control @error('tasks') is-invalid @enderror" id="taskId" name="tasks[]">
                                        <option value="" disabled selected>-- Select Tasks--</option>
                                        @foreach($tasks as $task)
                                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tasks')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <input type="hidden" id="userId" name="user_id" value="{{ $user->id }}">
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                    <div class="card-header">Update Reports</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('user-reports.update', $report->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $report->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ $report->content }}</textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="task">Tasks</label>
                                    <select multiple="multiple" class="form-control @error('tasks') is-invalid @enderror" id="taskId" name="tasks[]">
                                        @foreach($listTaskUser as $task)
                                            @if ($tasks->contains($task))
                                                <option value="{{ $task->id }}" selected="selected">
                                                    {{ $task->name }}
                                                </option>
                                            @else
                                                <option value="{{ $task->id }}">
                                                    {{ $task->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('tasks')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <input type="hidden" id="userId" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" value="{{ $report->id }}" id="reportId" name="report_id">
                                </div>
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

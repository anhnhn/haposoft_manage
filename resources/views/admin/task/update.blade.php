@extends('layouts.admin.master')
@section('title', ' Update Tasks')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Task</h3>
                        </div>
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group col-xs-6">
                                    <label for="name">Project</label>
                                    <select class="form-control col-xs-10 @error('project_id') is-invalid @enderror" name="project_id" id="projectId">
                                        @foreach($projects as $project)
                                            @if($project->id == $task->project_id)
                                                <option value="{{ $project->id }}" selected>{{ $project->name }}</option>
                                            @else
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="project">User</label>
                                    <select class="form-control col-xs-10 @error('user_id') is-invalid @enderror" name="user_id" id="userId">
                                        @foreach($projects as $project)
                                            @if($project->id == $task->project_id)
                                                <option value="">No User</option>
                                                @foreach($project->users()->get() as $user )
                                                    @if( $user->id == $task->user_id )
                                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                    @else
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            @elseif($project->id == $task->project_id && $task->user_id == null)
                                                <option value="" selected>No User</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $task->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3">{{ $task->content }}</textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="hours">Hours</label>
                                    <input type="number" class="form-control col-xs-6 @error('birth_day') is-invalid @enderror" id="hours" name="hours" value="{{ $task->hours }}">
                                    @error('hours')
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
@extends('layouts.admin.master')
@section('title', ' Tasks')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Task</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group col-xs-6">
                                    <label for="project">Project</label>
                                    <select class="form-control col-xs-10 @error('project_id') is-invalid @enderror" name="project_id" id="taskProjectId">
                                        <option value="" disabled selected>Choose your option</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="project">User</label>
                                    <select class="form-control col-xs-10 @error('user_id') is-invalid @enderror" name="user_id" id="userId">
                                        <option value="" selected>Choose your option</option>
                                    </select>
                                    @error('user_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name" value="{{old('name')}}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{old('content')}}" rows="3" placeholder="Enter ..."></textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="address">Hours</label>
                                    <input type="number" class="form-control @error('hours') is-invalid @enderror" min="0" id="hours" name="hours" placeholder="1" value="{{old('hours')}}">
                                    @error('hours')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
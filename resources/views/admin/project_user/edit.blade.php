@extends('layouts.admin.master')
@section('title', 'Edit Assign')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">Edit Assign</h3>
                        </div>
                        <div class="box-body">
                            <form role="form" method="POST"
                                  action="{{ route('projectuser.update', $projectId) }}"
                                  enctype="multipart/form-data" id="formEditProjectUser">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group col-xs-6">
                                        <label for="project">Projects</label>
                                        <select class="form-control col-xs-10 @error('project_id') is-invalid @enderror"
                                                name="project_id" id="projectId">
                                            <option value="{{ $projectUser->id }}"
                                                    selected>{{ $projectUser->name }}</option>
                                        </select>
                                        @error('project_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="department">Users</label>
                                        <select class="form-control col-xs-10 @error('user_id') is-invalid @enderror"
                                                name="user_id" id="userId">
                                            @foreach($projectUser->users as $user)
                                                @if($user->id == $userId)
                                                    <option value="{{ $user->id }}"
                                                            selected>{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="start_date">Start Date</label>
                                        <input type="date"
                                               class="form-control @error('start_date') is-invalid @enderror"
                                               id="startDate" name="start_date" value="{{$startDate}}">
                                        @error('start_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="end_date">End Date</label>
                                        <input type="date"
                                               class="form-control @error('end_date') is-invalid @enderror"
                                               id="endDate" name="end_date" value="{{$endDate}}">
                                        @error('end_date')
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
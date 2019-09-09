@extends('layouts.admin.master')
@section('title', 'Assign Users')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">Assign</h3>
                        </div>
                        <div class="box-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (Session::has('message'))
                                <h3 class="text-danger alert-success">{{ Session::get('message') }}</h3>
                            @endif
                                <form role="form" method="POST" action="{{ route('projectuser.store') }}" enctype="multipart/form-data" id="formAddUser">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group col-xs-4">
                                            <label for="project">Projects</label>
                                            <select class="form-control col-xs-10 @error('project_id') is-invalid @enderror" name="project_id" id="projectId">
                                                <option value="-1" disabled selected>Choose your option</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="department">Departments</label>
                                            <select class="form-control col-xs-10 @error('department_id') is-invalid @enderror" name="department_id" id="departmentId">
                                                <option value="-1" disabled selected>Choose your option</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-4">
                                            <label for="department">Users</label>
                                            <select class="form-control col-xs-10 @error('user_id') is-invalid @enderror" name="user_id" id="userId">
                                                <option value="-1" disabled selected>Choose your option</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-6 set-padding-top">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="startDate" name="start_date" value="{{old('start_date')}}">
                                        </div>
                                        <div class="form-group col-xs-6 set-padding-top">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="endDate" name="end_date" value="{{old('end_date')}}">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" id="assign">Assign</button>
                                    </div>
                                </form>
                            <table id="tableAssign" class="table table-bordered table-hover users-table">
                                <thead>
                                <tr>
                                    <th class="fix-witdh-name">Name Project</th>
                                    <th class="fix-witdh-start-date">Start date</th>
                                    <th class="fix-witdh-end-date">End Date</th>
                                    <th class="fix-witdh-content">User Name</th>
                                    <th class="fix-witdh-hours choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>User Name</th>
                                    <th class="choice">Choice</th>
                                </tr>
                                </tfoot>
                            </table>
{{--                            <div class="col-12 text-center">--}}
{{--                                {{ $projects->links() }}--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
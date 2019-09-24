@extends('layouts.admin.master')
@section('title', 'Manage Projects')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">List Projects</h3>
                            <form class="form-inline col-xs-7 text-center">
                                <label for="phone">Project</label>
                                <select class="form-control @error('project_id') is-invalid @enderror" name="project_id" id="projectId">
                                    <option value="-1" disabled selected>Choose your option</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </form>
                            <div class="col-xs-4 text-right">
                                <a href="{{ route('projectuser.create') }}" class="btn btn-info" role="button">Assign</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if (Session::has('message'))
                                <h3 class="text-danger">{{ Session::get('message') }}</h3>
                            @endif
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
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->end_date }}</td>
                                        <td>
                                            @foreach($project->users->unique('name') as $user)
                                                <button type="submit" class="btn btn-danger"> {{ $user->name }} </button>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('projects.show', $project->id) }}" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                                        </td>
                                    </tr>
                                @endforeach
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
                            <div class="col-12 text-center" id="paginate">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
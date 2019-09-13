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
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
                            <div class="col-xs-4 text-right">
                                <a href="{{ route('projects.create') }}" class="btn btn-info" role="button">Create</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if (Session::has('message'))
                                <h3 class="text-danger alert-success">{{ Session::get('message') }}</h3>
                            @endif
                            <table id="example2" class="table table-bordered table-hover users-table">
                                <thead>
                                <tr>
                                    <th class="fix-witdh-name">Name</th>
                                    <th class="fix-witdh-start-date">Start date</th>
                                    <th class="fix-witdh-end-date">End Date</th>
                                    <th class="fix-witdh-name">Customer</th>
                                    <th class="fix-witdh-choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($project->start_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($project->end_date)) }}</td>
                                        <td>{{ $project->customer['name'] }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('projects.show', $project->id) }}" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                                            <a href="{{ route('projects.edit', $project->id) }}" class="fa fa-edit btn-warning btn" role="button" title="Edit"></a>
                                            <form  method="POST" action="{{ route('projects.destroy', [$project->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="fa fa-remove btn-danger btn" role="button" title="Delete"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Customer</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
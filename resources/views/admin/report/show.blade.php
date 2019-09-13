@extends('layouts.admin.master')
@section('title', ' Show reports')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Daily Report
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box box-primary set-padding">
                    <div class="d-flex col-xs-12">
                        <div class="col-xs-4 avatar-mycss box-all">
                            <div class="form-group d-flex">
                                <label for="name" class="col-xs-4 col-form-label">User Name</label>
                                <div class="col-xs-8">
                                    <label for="name" class="col-form-label text-uppercase">{{ $report->user['name'] }}</label>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <label for="Date" class="col-xs-4 col-form-label">Date</label>
                                <div class="col-xs-8">
                                    <label for="name" class="col-form-label">{{ date('d-m-Y', strtotime($report->created_at)) }}</label>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <label for="content" class="col-xs-4 col-form-label">Content</label>
                                <div class="col-xs-8">
                                    <textarea class="form-control" id="content" name="content" rows="4" readonly>{{ $report->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="box-header text-center">
                                <h3 class="box-title">List Task</h3>
                            </div>
                            <table id="example2" class="table table-bordered table-hover users-table">
                                <thead>
                                <tr>
                                    <th class="fix-witdh-name-report">Name Task</th>
                                    <th class="fix-witdh-content-report">Link Task</th>
                                    <th class="fix-witdh-content-report">Name project</th>
                                    <th class="fix-witdh-hours">Hours</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->content }}</td>
                                        <td>{{ $task->project['name'] }}</td>
                                        <td>{{ $task->hours }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name Task</th>
                                    <th>Link Task</th>
                                    <th>Name Project</th>
                                    <th>Hours</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn-primary btn" role="button" title="Back">back</a>
            </div>
        </section>
    </div>
@endsection
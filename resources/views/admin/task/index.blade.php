@extends('layouts.admin.master')
@section('title', 'Manage Tasks')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title"> Tasks</h3>
                            <form class="form-inline col-xs-7 text-center">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
                            <div class="col-xs-4 text-right">
                                <a href="{{ route('tasks.create') }}" class="btn btn-info" role="button">Create</a>
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
                                    <th class="fix-witdh-content">Content</th>
                                    <th class="fix-witdh-hour">Hours</th>
                                    <th class="fix-witdh-user-name">User Name</th>
                                    <th class="fix-witdh-project-name">Project Name</th>
                                    <th class="fix-witdh-choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->content }}</td>
                                        <td>{{ $task->hours }}</td>
                                        <td>{{ $task->user['name'] }}</td>
                                        <td>{{ $task->project['name'] }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="fa fa-edit btn-warning btn" role="button" title="Edit"></a>
                                            <form  method="POST" action="{{ route('tasks.destroy', [$task->id]) }}">
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
                                    <th>Content</th>
                                    <th>Hours</th>
                                    <th>User Name</th>
                                    <th>Project Name</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $tasks->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
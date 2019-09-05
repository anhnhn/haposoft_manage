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
                    <div class="card-header">Show Projects</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Name Project</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Customer</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }} </td>
                                    <td>{{ $project->customer['name'] }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List Tasks</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered users-table">
                            <thead>
                            <tr>
                                <th scope="col" class="fix-witdh-name">Name Task</th>
                                <th scope="col" class="text-center fix-witdh-content">Content</th>
                                <th scope="col" class="text-center fix-witdh-name">User Name</th>
                                <th scope="col" class="fix-witdh-hour">Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->content }} </td>
                                    <td>{{ $task->user['name'] }} </td>
                                    <td>{{ $task->hours }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-12 text-center">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

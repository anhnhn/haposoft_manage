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
                    <div class="card-header d-flex">
                        <p class="col-4">Show Tasks</p>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (Session::has('message'))
                            <h3 class="text-danger">{{ Session::get('message') }}</h3>
                        @endif
                        <table class="table table-bordered users-table">
                            <thead>
                            <tr>
                                <th scope="col" class="fix-witdh-name">Name Tasks</th>
                                <th scope="col" class="fix-witdh-hours">Hours</th>
                                <th scope="col" class="fix-witdh-name">Link</th>
                                <th scope="col" class="fix-witdh-content">Content</th>
                                <th scope="col" class="fix-witdh-hours">Name Project</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->hours }}</td>
                                    <td>{{ $task->link }}</td>
                                    <td>{{ $task->content }}</td>
                                    <td>{{ $task->project['name'] }}</td>
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
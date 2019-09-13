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
                    <div class="card-header">Projects</div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <h3 class="text-danger alert-success">{{ Session::get('message') }}</h3>
                        @endif
                                <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Name Project</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->projects as $project )
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->end_date }} </td>
                                        <td>{{ $project->customer['name'] }} </td>
                                        <td>
                                            <a href="{{ route('user-projects.show', $project->id) }}" class="btn btn-info" role="button" title="Show">
                                                <i class="material-icons">youtube_searched_for</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <div class="col-12 text-center">--}}
{{--                                {{ $user->projects->links() }}--}}
{{--                            </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

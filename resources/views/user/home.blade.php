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
                        <h3 class="mt-1">Projects</h3>
                        <form class="form-inline col-10 d-flex justify-content-center" method="GET"
                              action="{{ route('user-projects.search') }}" id="formSearchUserProject">
                            <input class="form-control mr-2" type="text" placeholder="Name Project" name="project_name"
                                   value="{{ request('project_name') }}">
                            <input class="form-control" type="text" placeholder="Name Customer" name="customer_name"
                                   value="{{ request('customer_name') }}">
                            <button class="ml-2 btn-primary btn" role="button" title="name" id="searchUserProject"><i
                                        class="material-icons">youtube_searched_for</i></button>
                        </form>
                    </div>
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
                            @foreach($projects as $project )
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }} </td>
                                    <td>{{ $project->customer['name'] }} </td>
                                    <td>
                                        @if(Auth::user()->cant('viewProjectUser', $project))
                                            <a href="{{ route('user-projects.show', $project->id) }}" class="btn btn-info disabled"
                                               role="button" title="Show">
                                                <i class="material-icons">youtube_searched_for</i>
                                            </a>
                                        @else
                                            <a href="{{ route('user-projects.show', $project->id) }}" class="btn btn-info"
                                               role="button" title="Show">
                                                <i class="material-icons">youtube_searched_for</i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-12 d-flex justify-content-center">
                            {{ $projects->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

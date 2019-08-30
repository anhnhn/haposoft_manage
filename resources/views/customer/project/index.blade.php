@extends('layouts.app')

@section('logout')
    <a class="dropdown-item" href="{{ route('customers.logout') }}"
       onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('customers.logout') }}" method="GET" style="display: none;">
        @csrf
    </form>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <p class="col-4">Show Projects</p>
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
                                <th scope="col" class="fix-witdh-name">Name Project</th>
                                <th scope="col" class="fix-witdh-birth-day">Start Date </th>
                                <th scope="col" class="fix-witdh-birth-day">End Date</th>
                                <th scope="col" class="fix-witdh-choice">choice</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('customer-projects.show', $project->id)}}" class="btn btn-info mr-2" role="button" title="Show">
                                            <i class="material-icons">youtube_searched_for</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-12 text-center">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


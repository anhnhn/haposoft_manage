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
                        <p class="col-4">Show Reports</p>
                        <div class="col-8 text-right">
                            <a href="{{ route('users.createReport', $user->id) }}" class="btn btn-info mr-2" role="button" title="Show">
                                Create
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                                <h3 class="text-danger alert-success">{{ Session::get('message') }}</h3>
                        @endif
                        <table class="table table-bordered users-table">
                            <thead>
                            <tr>
                                <th scope="col" class="fix-witdh-name">Name Report</th>
                                <th scope="col" class="fix-witdh-birth-day">Date</th>
                                <th scope="col" class="fix-witdh-content">Content</th>
                                <th scope="col" class="fix-witdh-choice">choice</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr>
                                    <td>{{ $report->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($report->created_at)) }}</td>
                                    <td>{{ $report->content }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('user-reports.show', $report->id)}}" class="btn btn-info mr-2" role="button" title="Show">
                                            <i class="material-icons">youtube_searched_for</i>
                                        </a>
                                        <a href="{{ route('user-reports.edit', $report->id) }}" class="btn-warning btn mr-2" role="button" title="Edit">
                                            <i class="material-icons">
                                                card_travel
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{--                            <div class="col-12 text-center">--}}
                        {{--                                {{ Auth::user()->projects->links() }}--}}
                        {{--                            </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
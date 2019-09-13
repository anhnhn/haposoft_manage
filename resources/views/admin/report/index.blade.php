@extends('layouts.admin.master')
@section('title', 'Manage reports')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">List Reports</h3>
                            <form class="form-inline col-xs-7 text-center">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
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
                                    <th class="fix-witdh-name">User Name</th>
                                    <th class="fix-witdh-choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->name }}</td>
                                        <td>{{ $report->content }}</td>
                                        <td>{{ $report->user['name'] }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('reports.show', $report->id) }}" class="fa fa-search btn btn-info margin-r-5" role="button" title="Show"></a>
                                            <form  method="POST" action="{{ route('reports.destroy', [$report->id]) }}">
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
                                    <th>User Nảme</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $reports->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
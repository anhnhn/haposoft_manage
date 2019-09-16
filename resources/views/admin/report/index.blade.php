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
                            <form class="form-inline col-xs-7 text-center" method="GET" action="{{ route('reports.search') }}" id="formSearchReport">
                                <input class="form-control" type="text" placeholder="Search" name="report_name" value="{{ request('report_name') }}">
                                <button class="fa fa-search btn-primary btn" role="button" title="search" id="searchReport"></button>
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
                                                <button type="button" class="fa fa-remove btn-danger btn btn-delete" title="Delete" data-name="{{ $report->name }}"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Content</th>
                                    <th>User Name</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $reports->appends($_GET)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@extends('layouts.admin.master')
@section('title', 'Manage Departments')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">List Departments</h3>
                            <form class="form-inline col-xs-7 text-center" method="GET" action="{{ route('departments.search') }}" id="formSearchDepartment">
                                <input class="form-control" type="text" placeholder="Search" name="department_name" value="{{ request('department_name') }}">
                                <button class="fa fa-search btn-primary btn" role="button" title="search" id="searchDepartment"></button>
                            </form>
                            <div class="col-xs-4 text-right">
                                <a href="{{ route('departments.create') }}" class="btn btn-info" role="button">Create</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if (Session::has('message'))
                                <h3 class="text-danger alert-success">{{ Session::get('message') }}</h3>
                            @endif
                            <table id="tableDepartment" class="table table-bordered table-hover users-table">
                                <thead>
                                <tr>
                                    <th class="fix-witdh-name-department">Name</th>
                                    <th class="fix-witdh-choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td id="departmentName">
                                            {{ $department->name }}
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('departments.edit', $department->id) }}" class="fa fa-edit btn-warning btn" role="button" title="Edit"></a>
                                            <form  method="POST" action="{{ route('departments.destroy', [$department->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="button" class="fa fa-remove btn-danger btn btn-delete" title="Delete" data-name="{{ $department->name }}"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $departments->appends($_GET)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
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
                            <form class="form-inline col-xs-7 text-center">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
                            <div class="col-xs-4 text-right">
                                <a href="{{ route('departments.create') }}" class="btn btn-info" role="button">Create</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if (Session::has('message'))
                                <h3 class="text-danger">{{ Session::get('message') }}</h3>
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
                                                <button class="fa fa-remove btn-danger btn" role="button" title="Delete"></button>
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
                                {{ $departments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
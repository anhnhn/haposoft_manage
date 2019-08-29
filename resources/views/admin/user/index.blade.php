@extends('layouts.admin.master')
@section('title', 'Manage Users')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header d-flex ">
                            <h3 class="box-title">List Users</h3>
                            <div class="col-xs-11 text-right">
                                <a href="{{ route('users.create') }}" class="btn btn-info" role="button">Create</a>
                            </div>
                        </div>
                        <div class="box-body">
                            @if (Session::has('message'))
                                <h3 class="text-danger">{{ Session::get('message') }}</h3>
                            @endif
                            <table id="example2" class="table table-bordered table-hover users-table">
                                <thead>
                                <tr>
                                    <th class="fix-witdh-name">Name</th>
                                    <th class="fix-witdh-mail">Email</th>
                                    <th class="fix-witdh-password">Password</th>
                                    <th class="fix-witdh-birth-day">Birth day</th>
                                    <th class="fix-witdh-addess">Address</th>
                                    <th class="fix-witdh-phone">Phone</th>
                                    <th class="fix-witdh-choice">Choice</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->password }}</td>
                                            <td>{{ $user->birth_day }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td class="d-flex">
                                                    <a href="{{ route('users.show', $user->id) }}" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="fa fa-edit btn-warning btn" role="button" title="Edit"></a>
                                                <form  method="POST" action="{{ route('users.destroy', [$user->id]) }}">
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
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Birth day</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Choice</th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="col-12 text-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

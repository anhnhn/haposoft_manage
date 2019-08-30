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
                    <div class="card-header">Report</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                         <div class="d-flex">
                             <div class="col-4 table-bordered">
                                 <div class="form-group d-flex">
                                     <label for="name" class="col-4 form-label">User Name</label>
                                     <div class="col-6">
                                         <label for="name"
                                                class="form-label text-uppercase">{{ $report->user['name'] }}
                                         </label>
                                     </div>
                                 </div>
                                 <div class="form-group d-flex">
                                     <label for="date" class="col-4 form-label">Date</label>
                                     <div class="col-6">
                                         <label for="name" class="form-label">{{ $report->created_at }}</label>
                                     </div>
                                 </div>
                                 <div class="form-group d-flex">
                                     <label for="content" class="col-4 form-label">Content</label>
                                     <div class="col-8">
                                        <textarea class="form-control" id="content" name="content" rows="4"
                                                  readonly>{{ $report->content }}</textarea>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-8">
                                 <div>
                                     <h3 class="box-title">List Task</h3>
                                 </div>
                                 <table id="example2" class="table table-bordered table-hover users-table">
                                     <thead>
                                     <tr>
                                         <th class="fix-witdh-name-report">Name Task</th>
                                         <th class="fix-witdh-content-report">Link Task</th>
                                         <th class="fix-witdh-content-report">Name project</th>
                                         <th class="fix-witdh-hours">Hours</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach($tasks as $task)
                                         <tr>
                                             <td>{{ $task->name }}</td>
                                             <td>{{ $task->content }}</td>
                                             <td>{{ $task->project['name'] }}</td>
                                             <td>{{ $task->hours }}</td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                     <tfoot>
                                     <tr>
                                         <th>Name Task</th>
                                         <th>Link Task</th>
                                         <th>Name Project</th>
                                         <th>Hours</th>
                                     </tr>
                                     </tfoot>
                                 </table>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
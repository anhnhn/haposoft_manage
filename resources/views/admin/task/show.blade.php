@extends('layouts.admin.master')
@section('title', ' Informations Task')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Information Task
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12 box box-primary set-padding">
                    <div class="col-xs-10">
                        <div class="col-xs-12">
                            <form>
                                <div class="form-group d-flex">
                                    <label for="name" class="col-xs-3 col-form-label">Name Task</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $task->name }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="content" class="col-xs-3 col-form-label">Content</label>
                                    <div class="col-xs-10">
                                        <textarea class="form-control" id="content" name="content" rows="3" readonly>{{ $task->content }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="user" class="col-xs-3 col-form-label">User Name</label>
                                    <div class="col-xs-10">
                                        @if($task->user_id == null)
                                            <input type="text" readonly class="form-control" value='No user'>
                                        @else
                                            <input type="text" readonly class="form-control" value='{{ $task->user['name'] }}'>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="project" class="col-xs-3 col-form-label">Project Name</label>
                                    <div class="col-xs-10">
                                        <input type="text" readonly class="form-control" value='{{ $task->project['name'] }}'>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="hours" class="col-xs-3 col-form-label">Hours</label>
                                    <div class="col-xs-5">
                                        <input type="text" readonly class="form-control" value='{{ $task->hours }}'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn-primary btn" role="button" title="Back">back</a>
            </div>
        </section>
    </div>
@endsection
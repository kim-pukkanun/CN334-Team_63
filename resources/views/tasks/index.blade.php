@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-4">
            <h1><i class="border-start border-primary"></i> <a class="ms-1 text-black">New Task</a></h1>

            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
            <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Task Name -->
                <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deadline" class="col-sm-3 control-label">Deadline</label>

                    <div class="col-sm-6">
                        <input type="text" name="deadline" id="deadline" class="form-control">
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group" style="margin-top:20px">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i>Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Progress Bar -->
        <div class="progress mt-4" style="height: 20px;">
            <div
                    class="progress-bar bg-info"
                    role="progressbar"
                    style="width: {{ count($current_tasks) / $total * 100 }}%;"
                    aria-valuenow="{{ count($current_tasks) / $total * 100 }}"
                    aria-valuemin="0"
                    aria-valuemax="100"
            ></div>
            <div
                    class="progress-bar bg-danger"
                    role="progressbar"
                    style="width: {{ count($expired_tasks) / $total * 100 }}%;"
                    aria-valuenow="{{ count($expired_tasks) / $total * 100 }}"
                    aria-valuemin="0"
                    aria-valuemax="100"
            ></div>
            <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: {{ count($finished_tasks) / $total * 100 }}%;"
                    aria-valuenow="{{ count($finished_tasks) / $total * 100 }}"
                    aria-valuemin="0"
                    aria-valuemax="100"
            ></div>
        </div>

        <!-- Current Tasks -->
        @if (count($current_tasks) > 0)
            <div class="mt-4">
                <h2><i class="border-start border-info"></i> <a class="ms-1 text-black">Current Tasks</a></h2>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <th style="width: 65%">Task</th>
                        <th style="width: 15%">Deadline</th>
                        <th style="width: 20%">&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($current_tasks as $task)
                            <tr>
                                <td><div>{{ $task->name }}</div></td>
                                <td><div>{{ date("Y-m-d H:i:s", $task->deadline_at) }}</div></td>

                                <td>
                                    <form action="{{url('task/' . $task->id)}}" class="d-inline" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}

                                        <button type="submit" id="solve-task-{{ $task->id }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-check-square"></i> Finish
                                        </button>
                                    </form>

                                    <form action="{{url('task/' . $task->id)}}" class="d-inline" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-btn fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Expired Tasks -->
        @if (count($expired_tasks) > 0)
            <div class="mt-4">
                <h2><i class="border-start border-danger"></i> <a class="ms-1 text-black">Expired Tasks</a></h2>

                <table class="table table-striped">
                    <thead class="table-dark">
                    <th style="width: 65%">Task</th>
                    <th style="width: 15%">Deadline</th>
                    <th style="width: 20%">&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach ($expired_tasks as $task)
                        <tr>
                            <td><div>{{ $task->name }}</div></td>
                            <td><div>{{ date("Y-m-d H:i:s", $task->deadline_at) }}</div></td>

                            <td>
                                <form action="{{url('task/' . $task->id)}}" class="d-inline" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}

                                    <button type="submit" id="solve-task-{{ $task->id }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-check-square"></i> Finish
                                    </button>
                                </form>

                                <form action="{{url('task/' . $task->id)}}" class="d-inline" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-btn fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Finished Tasks -->
        @if (count($finished_tasks) > 0)
            <div class="mt-4">
                <h2><i class="border-start border-success"></i> <a class="ms-1 text-black">Finished Tasks</a></h2>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <th style="width: 65%">Task</th>
                        <th style="width: 15%">Deadline</th>
                        <th style="width: 20%">&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach ($finished_tasks as $task)
                        <tr>
                            <td><div>{{ $task->name }}</div></td>
                            <td><div>{{ date("Y-m-d H:i:s", $task->deadline_at) }}</div></td>

                            <td>
                                <form action="{{url('task/' . $task->id)}}" class="d-inline" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-btn fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        </div>
    <script type="text/javascript">
        var dateToday = new Date();
        $('#deadline').datetimepicker({
            minDate: dateToday,
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            stepSecond: 60
        });
    </script>
@endsection

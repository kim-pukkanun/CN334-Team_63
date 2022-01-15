@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="text-left mb-3 badge bg-light text-dark border border-dark" style="margin-top:25px">
                    <h1>New Task</h1>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label badge bg-info text-black"><h5>Task</h5></label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control p" value="{{ old('task') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deadline" class="col-sm-3 control-label badge bg-info text-black"><h5>Deadline</h5></label>

                            <div class="col-sm-6">
                                <input type="text" name="deadline" id="deadline" class="form-control p5">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel-heading">
                    <div class="text-left mb-3 badge bg-light text-dark border border-dark" style="margin-top:25px">
                        <h2>Current Task</h2>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th class="rounded">Task</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('task/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
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

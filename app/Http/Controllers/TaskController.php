<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $current_tasks = $this->tasks->currentTasks($request->user());
        $expired_tasks = $this->tasks->expiredTasks($request->user());
        $finished_tasks = $this->tasks->finishedTasks($request->user());
        $total = count($current_tasks) + count($expired_tasks) + count($finished_tasks) != 0 ? count($current_tasks) + count($expired_tasks) + count($finished_tasks) : 1;

        return view('tasks.index', [
            'current_tasks' => $current_tasks,
            'expired_tasks' => $expired_tasks,
            'finished_tasks' => $finished_tasks,
            'total' => $total
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'deadline' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
            'deadline_at' => $request->deadline
        ]);

        return redirect('/tasks');
    }

    /**
     * Finish the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function finish(Request $request, Task $task)
    {
        $this->authorize('access', $task);

        $task->update(['finished' => 1]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('access', $task);

        $task->delete();

        return redirect('/tasks');
    }
}

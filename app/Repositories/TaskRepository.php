<?php

namespace App\Repositories;

use App\User;
use App\Task;
use Carbon\Carbon;

class TaskRepository
{
    public function currentTasks(User $user)
    {
        return Task::where([
            ['user_id', '=' , $user->id],
            ['finished', '=', 0],
            ['deadline_at', '>', Carbon::now()]
        ])
            ->orderBy('deadline_at', 'asc')
            ->get();
    }

    public function expiredTasks(User $user)
    {
        return Task::where([
            ['user_id', '=' , $user->id],
            ['finished', '=', 0],
            ['deadline_at', '<', Carbon::now()]
        ])
            ->orderBy('deadline_at', 'asc')
            ->get();
    }

    public function finishedTasks(User $user)
    {
        return Task::where([
            ['user_id', '=' , $user->id],
            ['finished', '=', 1]
        ])
            ->orderBy('created_at', 'asc')
            ->get();
    }
}

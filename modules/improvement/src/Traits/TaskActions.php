<?php

namespace App\Module\Improvement\Traits;

use App\Module\Improvement\Models\Task;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Validator;

trait TaskActions
{

    /**
     * @return array
     */
    protected function taskRules()
    {
        return [
            'name' => 'required|string|min:3|max:191',
            'is_active' => 'int'
        ];
    }


    public function tasksData(User $user)
    {
        return DataTables::of($user->tasks()->get())
            ->addColumn('name', function($task) {

                return view('improvement::components.input-task-name', compact('task'));
            })
            ->addColumn('is_active', function($task) {

                return view('improvement::components.task-status', compact('task'));
            })
            ->addColumn('delete', function($task) {

                return view('improvement::components.button-delete-task', compact('task'));
            })
            ->rawColumns(['name', 'is_active', 'delete'])
            ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function storeTask(Request $request, User $user)
    {
        return $this->store($request, $user, 'Task');
    }


    public function updateTask(Request $request, Task $task)
    {
        return $this->update($request, $task, 'Task');
    }


    public function deleteTask(Task $task)
    {
        return $this->destroy($task, 'Task');
    }

}
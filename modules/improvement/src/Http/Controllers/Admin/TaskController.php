<?php

namespace App\Module\Improvement\Http\Controllers\Admin;


use App\User;
use Yajra\DataTables\DataTables;

class TaskController extends ImprovementController
{
    protected $module = 'improvement';
    protected $modelName = 'Task';


    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:191',
            'is_active' => 'int'
        ];
    }

    public function data(User $user)
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
}

<?php

namespace App\Module\Improvement\Traits;


use App\Module\Improvement\Models\Task;

trait TaskUserRelatedMethods
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getTasks()
    {
        return $this->tasks()->where('is_active', 1)->get();
    }

    /**
     * Create Task
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setTask($request)
    {
        return $this->tasks()->create($request);
    }

}
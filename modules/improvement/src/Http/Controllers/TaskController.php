<?php

namespace App\Module\Improvement\Http\Controllers;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    protected $module = 'improvement';


    public function data()
    {
        return auth()->user()->getTasks();
    }
}

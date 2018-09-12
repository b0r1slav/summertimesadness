<?php

namespace App\Module\Dashboard\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $module = 'dashboard';

    public function index()
    {
        return view('dashboard::admin.dashboard.index');
    }
}

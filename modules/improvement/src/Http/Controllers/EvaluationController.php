<?php

namespace App\Module\Improvement\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Validator;


class EvaluationController extends Controller
{
    protected $module = 'improvement';

    public function index()
    {
        return view('improvement::user.evaluations.index');
    }


    public function data()
    {
        return DataTables::of(auth()->user()->getEvaluations())
            ->addColumn('action', function($evaluation) {

                return view('improvement::components.button-add-points', compact('evaluation'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}

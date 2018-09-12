<?php

namespace App\Module\Improvement\Http\Controllers\Admin;

use App\Module\Improvement\Traits\EvaluationActions;
use App\Module\Improvement\Traits\PointsApprovementActions;
use App\Module\Improvement\Traits\TaskActions;
use Validator;
use App\User;
use App\Http\Controllers\Controller;

class ImprovementController extends Controller
{
    use EvaluationActions;
    use PointsApprovementActions;
    use TaskActions;


    protected $module = 'improvement';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('improvement::admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('improvement::admin.show', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @param $user
     * @param $model
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store($request, $user, $model)
    {
        $message = "The $model was successfully created!";

        $validator = Validator::make($request->all(), $this->{strtolower($model) . 'Rules'}());

        if ($validator->fails()) {

            return view('components.errors')->withErrors($validator);
        }

        $input = filter_array($request->except(['_method', '_token']));

        $user->{"set$model"}($input);

        return view('components.success', compact('message'));
    }


    public function update($request, $instance, $model)
    {
        $rules = $this->{strtolower($model) . 'Rules'}();

        $key = array_keys($request->except(['_method', '_token']));

        $input = filter_array($request->except(['_method', '_token']));

        $validator = Validator::make($input, [$key[0] => $rules[$key[0]]]);

        if ($validator->fails()) {

            return response()->json(['error' => true, 'errors' => $validator->errors()], 422);
        }

        try {
            $instance->update($request->all());

        } catch (\Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json(['error' => false]);

    }


    public function destroy($instance, $model)
    {
        $message = "The $model was successfully deleted!";

        try {
            $instance->delete();

        } catch (\Exception $e) {
            $message = "The $model not found!";

            return view('components.error', compact('message'));
        }

        return view('components.success', compact('message'));

    }
}

<?php

namespace App\Module\Improvement\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;

class ImprovementController extends Controller
{
    protected $module = 'improvement';
    protected $modelName;


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
     * @param Request $request
     * @param User $user
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, User $user)
    {
        $message = "The {$this->modelName} was successfully created!";

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {

            return view('components.errors')->withErrors($validator);
        }

        $input = filter_array($request->except(['_method', '_token']));

        $user->{"set{$this->modelName}"}($input);

        return view('components.success', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $item = app("App\\Module\\Improvement\\Models\\$this->modelName")::find($id);

        $rules = $this->rules();

        $key = array_keys($request->except(['_method', '_token']));

        $input = filter_array($request->except(['_method', '_token']));

        $validator = Validator::make($input, [$key[0] => $rules[$key[0]]]);

        if ($validator->fails()) {

            return response()->json(['error' => true, 'errors' => $validator->errors()], 422);
        }

        try {
            $item->update($request->all());

        } catch (\Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json(['error' => false]);

    }


    /**
     * Destroy the specified resource in storage.
     *
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy($id)
    {
        $item = app("App\\Module\\Improvement\\Models\\$this->modelName")::find($id);

        $message = "The {$this->modelName} was successfully deleted!";

        try {
            $item->delete();

        } catch (\Exception $e) {
            $message = "The {$this->modelName} not found!";

            return view('components.error', compact('message'));
        }

        return view('components.success', compact('message'));

    }
}

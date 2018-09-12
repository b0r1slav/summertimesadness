<?php

namespace App\Module\Improvement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Module\Improvement\Models\PointsApprovement;
use Illuminate\Http\Request;
use Validator;

class PointsApprovementController extends Controller
{
    protected $module = 'improvement';


    public function data()
    {
        return auth()->user()->getPointsApprovement();
    }


    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'points' => 'required|numeric',
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $message = 'Points approvement was successfully created!';

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {

            return view('components.errors')->withErrors($validator);
        }

        try {
            auth()->user()->setPointsApprovement($request->all());

        } catch (\Exception $e) {

            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return view('components.success', compact('message'));
    }

    public function destroy(PointsApprovement $pointsApprovement)
    {
        if ($pointsApprovement->status === 'pending') {

            $pointsApprovement->delete();

        } else {

            $pointsApprovement->update(['is_active' => 0]);

        }
    }

}

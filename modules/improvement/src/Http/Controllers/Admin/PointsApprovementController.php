<?php

namespace App\Module\Improvement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Module\Improvement\Models\Evaluation;
use Illuminate\Http\Request;
use App\Module\Improvement\Models\PointsApprovement;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PointsApprovementController extends Controller
{
    protected $module = 'improvement';
    protected $modelName = 'PointsApprovement';

    /**
     * @param PointsApprovement $pointsApprovement
     * @return mixed
     */
    public function getPointsApprovementCount(PointsApprovement $pointsApprovement)
    {
        return $pointsApprovement->pointsApprovementCount();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('improvement::admin.points-approvement');
    }

    /**
     * @param PointsApprovement $pointsApprovement
     * @return mixed
     */
    public function data(PointsApprovement $pointsApprovement)
    {
        return DataTables::of($pointsApprovement->getPointsApprovements())
            ->addColumn('action', function($pointsApprovement) {

                return view('improvement::components.buttons-points-approvement', compact('pointsApprovement'));
            })
            ->addColumn('checkbox', function($pointsApprovement) {

                return view('improvement::components.checkbox-points-approvement', compact('pointsApprovement'));
            })
            ->rawColumns(['action', 'checkbox'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @param PointsApprovement $pointsApprovement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updatePointsApprovement(Request $request, PointsApprovement $pointsApprovement)
    {
        $event = $request->status === 'refused' ? 'refused' : 'approved';

        $message = $pointsApprovement->points . " points were $event!";

        try {

            DB::transaction(function () use ($pointsApprovement, $request)
            {
                if ($request->status === 'approved') {

                    Evaluation::updateCurrentPoints($pointsApprovement);

                }

                $pointsApprovement->update(['status' => $request->status]);
            });

        } catch (\Exception $e) {

            $message = 'Oops! Something went wrong. Please try again.';

            return view('components.error', compact('message'));
        }

        return view('components.success', compact('message'));
    }

    /**
     * @param Request $request
     * @param PointsApprovement $pointsApprovement
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateBulkPointsApprovement(Request $request, PointsApprovement $pointsApprovement)
    {
        $evaluations = is_array($request->bulkValues) ? $request->bulkValues : (array) $request->bulkValues;

        $message = $request->bulkLength . ' entries were approved!';

        $bulkIds = $request->bulkIds;

        try {

            DB::transaction(function () use ($pointsApprovement, $bulkIds, $evaluations)
            {
                Evaluation::massUpdate($evaluations, 'current');

                $pointsApprovement->bulkUpdate($bulkIds);
            });

        } catch (\Exception $e) {

            $message = 'Oops! Something went wrong. Please try again.';

            return view('components.error', compact('message'));
        }

        return view('components.success', compact('message'));
    }
}
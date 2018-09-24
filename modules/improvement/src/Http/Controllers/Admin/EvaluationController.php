<?php namespace App\Module\Improvement\Http\Controllers\Admin;

use App\Module\Improvement\Models\Evaluation;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EvaluationController extends ImprovementController
{
    protected $module = 'improvement';
    protected $modelName = 'Evaluation';


    /**
     * @return array
     */
    protected function rules()
    {
        return [
            'title' => 'required|string|min:3|max:191',
            'must' => 'required|numeric',
            'current' => 'nullable|numeric',
        ];
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function data(User $user)
    {

        return DataTables::of($user->all())
            ->addColumn('action', function($user) {

                return view('improvement::components.button-user-evaluations', compact('user'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function dataUserEvaluations(User $user)
    {

        return DataTables::of($user->evaluations()->where('is_active', 1)->get())
            ->addColumn('title', function($evaluation) {

                return view('improvement::components.input-evaluation-title', compact('evaluation'));
            })
            ->addColumn('must', function($evaluation) {

                return view('improvement::components.input-evaluation-must', compact('evaluation'));
            })
            ->addColumn('current', function($evaluation) {

                return view('improvement::components.input-evaluation-current', compact('evaluation'));
            })
            ->addColumn('action', function($evaluation) {

                return view('improvement::components.button-delete-evaluation', compact('evaluation'));
            })
            ->rawColumns(['title', 'must', 'current', 'action'])
            ->make(true);
    }


    /**
     * Update the specified evaluation
     *
     * @param Request $request
     * @param Evaluation $evaluation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function updateEvaluation(Request $request, Evaluation $evaluation)
    {
        if ($request->has('is_active')) {

            return $this->delete($evaluation);
        }

        return parent::update($evaluation->id, $request);

    }

    /**
     * Change the status of specified evaluation
     *
     * @param Evaluation $evaluation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Evaluation $evaluation)
    {
        $message = 'The evaluation was successfully deleted!';

        try {
            $evaluation->update(['is_active' => 0]);

        } catch (\Exception $e) {
            $message = 'The evaluation not found!';

            return view('components.error', compact('message'));
        }

        return view('components.success', compact('message'));
    }
}

<?php

namespace App\Module\Improvement\Traits;


use App\Module\Improvement\Models\Evaluation;

trait EvaluationUserRelatedMethods
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Get all user evaluations
     *
     * @return mixed
     */
    public function getEvaluations()
    {
        return $this->evaluations()->where('is_active', 1)->get();
    }

    /**
     * Create Evaluation
     *
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setEvaluation($request)
    {
        return $this->evaluations()->create($request);
    }
}
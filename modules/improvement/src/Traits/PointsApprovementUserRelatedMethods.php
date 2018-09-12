<?php

namespace App\Module\Improvement\Traits;

use App\Module\Improvement\Models\PointsApprovement;
use Illuminate\Support\Facades\DB;

trait PointsApprovementUserRelatedMethods
{
    public function pointsApprovement()
    {
        return $this->hasMany(PointsApprovement::class);
    }

    public function getPointsApprovement()
    {
        return DB::select("SELECT pa.id, pa.user_id AS pa_user_id, pa.is_active AS pa_is_active, pa.points, pa.status, pa.created_at AS pa_date, e.title
                            FROM points_approvements AS pa
                            JOIN evaluations AS e ON pa.evaluation_id = e.id
                            WHERE pa.user_id = $this->id AND pa.is_active = 1");
    }

    public function setPointsApprovement($request)
    {
        return $this->pointsApprovement()->create($request);
    }
}
<?php

namespace App\Module\Improvement\Models;

use App\Traits\MassUpdate;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use MassUpdate;

    protected $table = 'evaluations';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'title', 'must', 'current', 'is_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all evaluations with users
     */
    public function getEvaluations()
    {
        return $this->with('user')->get();
    }

    public static function updateCurrentPoints($pointsApprovement)
    {
        return self::find($pointsApprovement->evaluation_id)->increment('current', $pointsApprovement->points);
    }

    public static function massUpdate($resource, $column)
    {

        if ( array_key_exists('all', $resource) ) {

            $resource = PointsApprovement::getNotApproved();

        }

        return (new self)->updateMass($resource, $column);

    }
}

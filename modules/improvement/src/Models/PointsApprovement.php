<?php 

namespace App\Module\Improvement\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PointsApprovement extends Model
{
    protected $table = 'points_approvements';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'evaluation_id', 'points', 'is_active', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getPointsApprovements()
    {
        return $this->select('points_approvements.*', 'evaluations.title', 'users.name')
            ->join('evaluations','evaluations.id','=','points_approvements.evaluation_id')
            ->join('users','users.id','=','points_approvements.user_id')
            ->where('points_approvements.status', '=', 'pending')
            ->get();
    }


    public static function getNotApproved()
    {
        $records = DB::select("SELECT evaluation_id, SUM(points) AS points FROM points_approvements WHERE status = 'pending' GROUP BY evaluation_id");

        return array_pluck($records, 'points', 'evaluation_id');
    }


    public function pointsApprovementCount()
    {
        return $this->where('status', 'pending')->count();
    }


    public function bulkUpdate($data)
    {
        if($data[0] === 'all') {

            return $this->where('status', 'pending')->update(['status' => 'approved']);
        }

        return $this->whereIn('id', $data)->update(['status' => 'approved']);
    }
}

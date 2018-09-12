<?php

namespace App;

use App\Module\Improvement\Traits\EvaluationUserRelatedMethods;
use App\Module\Improvement\Traits\PointsApprovementUserRelatedMethods;
use App\Module\Improvement\Traits\TaskUserRelatedMethods;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EvaluationUserRelatedMethods;
    use PointsApprovementUserRelatedMethods;
    use TaskUserRelatedMethods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }
}

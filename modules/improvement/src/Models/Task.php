<?php

namespace App\Module\Improvement\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'name', 'is_active'];


    public function user()
    {
        $this->belongsTo(User::class);
    }
}

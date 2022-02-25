<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\GoalType;

class Goal extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'goal_type_id',
    	'subject', 
        'target_achievement', 
        'start_date',
        'end_date',
        'description', 
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function gtype()
    {
        return $this->belongsTo(GoalType::class, 'goal_type_id');
    }
}

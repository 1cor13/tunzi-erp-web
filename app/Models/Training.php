<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\TrainingType;
use App\Models\Trainer;

class Training extends Model
{
   use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'training_cost', 
        'start_date',
        'end_date',
        'description', 
        'status',
        'employee_id',
        'training_type_id',
        'trainer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function tratype()
    {
        return $this->belongsTo(TrainingType::class, 'training_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}

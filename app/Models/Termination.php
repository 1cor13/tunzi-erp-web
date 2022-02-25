<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\TerminationType;

class Termination extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'employee_id', 
        'termination_type_id', 
        'termination_date', 
        'termination_reason', 
        'notice_date',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function tertype()
    {
        return $this->belongsTo(TerminationType::class, 'termination_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

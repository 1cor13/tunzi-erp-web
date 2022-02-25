<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\Project;

class EmployeeTimeSheet extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'deadline', 
        'total_hours', 
        'remaining_hours', 
        'timesheet_date', 
        'timesheet_hours', 
        'description',
        'project_id',
        'employee_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

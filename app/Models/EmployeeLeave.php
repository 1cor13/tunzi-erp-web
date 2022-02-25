<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\EmployeeLeaveType;
use App\Models\User;

class EmployeeLeave extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
    	'number_of_days', 
        'remaining_leaves', 
        'leave_reason',
        'status',
        'employee_leave_type_id',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function empleavetype()
    {
        return $this->belongsTo(EmployeeLeaveType::class, 'employee_leave_type_id');
    }
}

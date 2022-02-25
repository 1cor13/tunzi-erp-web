<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\User;

class EmployeeOverTime extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'overtime_date', 
        'overtime_hours', 
        'description',
        'status',
        'employee_id',
        'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

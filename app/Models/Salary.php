<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;

class Salary extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'net_salary',
        'pay_slip',
        'status',
        'basic_salary',
        'house_allowance',
        'allowance',
        'medical_allowance',
        'conveyance',
        'other_earning_allowance',
        'total_earnings',
        'tax_deducated',
        'provident_fund',
        'loan',
        'leave',
        'labour_welfare',
        'prof_tax',
        'other_deduction_allowance',
        'total_deductions',
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
}

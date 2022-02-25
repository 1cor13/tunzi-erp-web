<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Company;
use App\Models\User;

use App\Models\EmployeeHoliday;
use App\Models\Customer;
use App\Models\Project;

class Employee extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'first_name', 
        'last_name', 
        'username', 
        'email',
        'password',
        'joining_date',
        'employee_phone',
        'department_id',
        'designation_id',
        'company_id',
        'user_id',
        'employee_holiday_id',
        'customer_id',
        'project_id'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function holiday(){

        return $this->belongsTo(EmployeeHoliday::class);
    }

    public function customer(){

        return $this->belongsTo(Customer::class);
    }

    public function project(){

        return $this->belongsTo(Project::class);
    }

}

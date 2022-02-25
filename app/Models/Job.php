<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Department;
use App\Models\JobType;
use App\Models\JobApplicant;

class Job extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'job_title', 
        'job_location', 
        'num_of_vacancies', 
        'experience', 
        'age', 
        'salary_from', 
        'salary_to',
        'start_date', 
        'expired_date', 
        'description',
        'status', 
        'department_id',
        'job_type_id',
        'job_applicant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jtype()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function jbapp()
    {
        return $this->belongsTo(JobApplicant::class, 'job_applicant_id');
    }
}

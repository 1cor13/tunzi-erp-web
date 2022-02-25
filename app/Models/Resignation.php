<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;

class Resignation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'notice_date', 
        'resignation_date', 
        'resignation_reason', 
        'employee_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

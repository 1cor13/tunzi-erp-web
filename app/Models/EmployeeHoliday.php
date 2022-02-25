<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeHoliday extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'holiday_name', 
        'start_date',
        'end_date',
        'description',
        'status'
    ];

    /**
     * The string variable is for the table.
     *
     * @var array
     */
    protected $table = 'employee_holidays';
}

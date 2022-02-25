<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;

class Department extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'department_name', 
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

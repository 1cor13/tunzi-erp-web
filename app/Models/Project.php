<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Customer;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'project_name',
        'customer_id',
        'start_date',
        'end_date',
        'rate', 
        'priority',
        'project_leader', 
        'project_team', 
        'project_description',
        'status',
        'image'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

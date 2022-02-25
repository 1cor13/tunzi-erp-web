<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\User;

class Asset extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'asset_name', 
        'purchase_date', 
        'purchase_from', 
        'manufacturer', 
        'model', 
        'serial_number', 
        'supplier', 
        'condition',
        'warranty', 
        'value', 
        'description', 
        'status',
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

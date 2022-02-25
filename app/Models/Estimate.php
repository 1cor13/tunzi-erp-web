<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client;
use App\Models\Project;
use App\Models\Tax;

class Estimate extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estimate_number',
        'email',
        'client_address',
        'billing_address', 
        'estimate_date', 
        'expiry_date', 
        'item', 
        'description', 
        'unit_cost', 
        'quantity', 
        'amount', 
        'discount', 
        'status',
        'client_id',
        'project_id',
        'tax_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}

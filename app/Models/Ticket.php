<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Employee;
use App\Models\Client;

class Ticket extends Model
{
     use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
    	'ticket_subject', 
        'priority',
        'status', 
        'ticket_description',
        'image',
        'client_id',
        'employee_id'
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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id', 'short_name', 'insurance_description', 'status'
    ];

    protected $table = 'insurances';
}

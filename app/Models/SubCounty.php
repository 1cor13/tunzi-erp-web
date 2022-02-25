<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    use HasFactory;

    protected $fillable = [
    	'district_id', 
    	'county_name', 
    	'county_code', 
    	'county_status'
    ];

    protected $table = 'sub_counties';
}

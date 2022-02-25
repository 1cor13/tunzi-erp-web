<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MobileSchems extends Model
{
	use SoftDeletes;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'db_name', 'db_version', 'db_encrypted', 'db_mode', 'db_tables'
    ];

    protected $casts = [
        'steps' => 'array'
    ];
}

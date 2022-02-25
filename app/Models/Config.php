<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id', 
    	'lastLogin', 
    	'search_item', 
    	'theme_color'
    ];

    protected $table = 'configs';
}

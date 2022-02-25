<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'name', 'code', 'rate', 'precision', 'symbol', 'symbol_position', 'decimal_mark', 'separate', 'status' , 'default_currency'
    ];

    protected $table = 'currencies';
}

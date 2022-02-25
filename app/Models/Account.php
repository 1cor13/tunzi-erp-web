<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Currency;

class Account extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
        'number',
        'currency_id',
        'opening_balance',
        'bank_name',
        'bank_phone',
        'bank_address',
        'default_account',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table='accounts';

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}

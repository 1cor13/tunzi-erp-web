<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Account;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'date',
        'description',
        'pay_method',
        'reference',
        'account_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table='transfers';

    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Revenue;
use App\Models\Payment;
use App\Models\Account;
use App\Models\Category;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'amount',
        'type',
        'description',
        'revenue_id',
        'payment_id',
        'account_id',
        'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table='transactions';

    public function revenue()
    {
        return $this->belongsTo(Revenue::class,'revenue_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}

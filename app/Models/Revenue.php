<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Invoice;

class Revenue extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 
        'amount', 
        'description', 
        'recurring',
        'pay_method',
        'reference',
        'attachment',
        'account_id',
        'customer_id',
        'category_id',
        'invoice_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

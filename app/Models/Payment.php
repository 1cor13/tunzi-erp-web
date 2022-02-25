<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Account;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Bill;

class Payment extends Model
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
        'account_id',
        'vendor_id',
        'description',
        'category_id',
        'recurring',
        'pay_method',
        'reference',
        'bill_id',
        'attachment'
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

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}

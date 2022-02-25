<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;

class Bill extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'bill_date',
        'bill_number', 
        'due_date',
        'order_number',
        'quantity',
        'amount',
        'subtotal',
        'discount',
        'total',
        'currency_id',
        'product_id',
        'category_id',
        'vendor_id',
        'notes',
        'recurring',
        'attachment',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table='bills';

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

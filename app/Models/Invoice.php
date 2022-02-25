<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Category;

class Invoice extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'company_id',
        'customer_id',
        'invoice_date',
        'invoice_number', 
        'due_date',
        'product_id',
        'quantity',
        'amount',
        'subtotal',
        'discount',
        'total',
        'currency_id',
        'notes',
        'footer',
        'recurring',
        'category_id',
        'attachment',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table='invoices';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   
}

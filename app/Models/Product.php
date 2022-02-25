<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Tax;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'product_name', 
        'tax_id', 
        'description', 
        'sale_price',
        'purchase_price',
        'category_id',  
        'image', 
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class,  'category_id');
    }

    public function tax(){
        return $this->belongsTo(Tax::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Village;
use App\Models\User;

class Store extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'store_name', 
        'store_phone', 
        'store_email', 
        'category_id',
        'time_open', 
        'time_closed', 
        'store_whatsapp', 
        'store_facebook',
        'store_twitter', 
        'store_instagram', 
        'store_lat', 
        'store_long', 
        'village_id',
        'status', 
        'store_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

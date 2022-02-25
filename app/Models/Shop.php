<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;
use App\Models\Village;
use App\Models\User;

class Shop extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'shop_name', 
        'shop_phone', 
        'shop_email', 
        'time_open', 
        'time_closed', 
        'shop_whatsapp', 
        'shop_facebook',
        'shop_twitter', 
        'shop_instagram', 
        'shop_lat', 
        'shop_long', 
        'shop_description',
        'user_id',
        'village_id',
        'gallery_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

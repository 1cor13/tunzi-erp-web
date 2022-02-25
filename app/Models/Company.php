<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CompanyUser;
use App\Models\Currency;
use App\Models\User;

class Company extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name','email','phone','tax_number','language_id','address','logo','status','currency_id','country_id','village_id','gallery_id','user_id','other_languages'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Display a listing of the resource.
     *
     * @var object
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Belongs to resource relationship.
     *
     * @var object
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Has many relationship
     * @var array
     */
    public function users()
    {
        return $this->hasMany(CompanyUser::class);
    }
}

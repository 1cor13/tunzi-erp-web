<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;
use App\Models\Image;

class Gallery extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'gallery_id',
        'gallery_name',
        'description',
        'status'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * belongs to relationship 
     * 
     * @var object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}


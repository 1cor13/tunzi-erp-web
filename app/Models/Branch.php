<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SubCounty;
use App\Models\District;
use App\Models\Gallery;
use App\Models\Customer;
use App\Models\village;
use App\Models\User;

class Branch extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'branch_name', 'branch_code', 'gallery_id', 'branch_phone1', 'branch_phone2', 'branch_email',
    	'branch_description', 'district_id', 'sub_county_id', 'village_id', 'branch_street', 
    	'customer_id','user_id', 'open_hours', 'gps_lat', 'gps_long', 'branch_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var string
     */
    protected $table = 'branches';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function subcounty()
    {
        return $this->belongsTo(SubCounty::class, 'sub_county_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function gallery()
    {
    	return $this->belongsTo(Gallery::class, 'gallery_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function village()
    {
    	return $this->belongsTo(User::class, 'village_id');
    }
}

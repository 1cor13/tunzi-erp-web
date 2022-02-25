<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'village_name', 'village_code', 'village_status', 'sub_county_id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @var object
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}

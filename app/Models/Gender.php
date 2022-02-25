<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
    	'gender_name', 'gender_description', 'status'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_gender()
    {
        return $this->hasMany(User::class);
    }
}

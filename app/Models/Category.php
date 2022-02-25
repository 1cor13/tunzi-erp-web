<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Category extends Model
{
     use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'scoped', 'name', 'type', 'color', 'status','user_id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Belongs to relationship
     * 
     * @var object
     */
    public function author(){
        return $this->belongsTo(User::class);
    }
}

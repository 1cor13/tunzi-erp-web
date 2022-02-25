<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\User;

class Image extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gallery_id', 'featured', 'featured_no', 'image_name', 'image_path', 'alternative_text', 'image_caption'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Belongs to relationship 
     * 
     * @var object
     */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Belongs to relationship 
     * 
     * @var object
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}

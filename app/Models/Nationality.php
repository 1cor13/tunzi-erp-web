<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable = [
    	'country_id', 'nationality_name', 'nationality_code', 'description', 'status'
    ];

    protected $table = 'nationalities';

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

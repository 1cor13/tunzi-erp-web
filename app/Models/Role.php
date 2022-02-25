<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use App\Models\Permission;

class Role extends LaratrustRole
{
    public $guarded = [];

    // /**
    //  * Has many relationship
    //  * @var array
    //  */
    // public function permissions(){
    //     return $this->hasMany(Permission::class);
    // }
}

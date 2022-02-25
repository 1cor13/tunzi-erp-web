<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laratrust\Traits\LaratrustUserTrait;

use App\Models\Company;
use App\Models\Country;
use App\Models\CategorySection;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * For capturing the events on a user chane event
     * 
     * This is applicable for the following events
     * roleAttached, roleDetached, permissionAttached, permissionDetached, roleSynced, permissionSynced
     *
     * Inside the Role model only the permissionAttached, permissionDetached and permissionSynced events will be fired.
     */
    public static function boot() {
        parent::boot();

        static::roleAttached(function($user, $role, $team) {
        });
        static::roleSynced(function($user, $changes, $team) {
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 
        'phone', 'occupation', 'gender_id', 'country_id', 'reg_date', 'image_type', 'source',
        'date_of_birth', 'account_no', 'image_path', 'bio', 'username', 'receive_messages',
        'account_auth', 'email_notifications', 'facebook_link', 'twitter_link', 'linkedin_link', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The function to returna string of the user roles
     * 
     * @var string
     */
    public function userRole()
    {
        $roles  = [];
        $ret_string = '';

        foreach ($this->getRoles() as $value) {
            $name = Role::where( 'name', $value )->first()->display_name;
            $roles[] = $name ?? '';
        }

        if ( sizeof( $roles ) == 1 ) {
            $ret_string = $roles[0];
        } 
        elseif ( sizeof( $roles ) >= 1 ) {
            $nn = sizeof( $roles );
            foreach ($roles as $val) {
                $ret_string .= ($val . ((int) $nn > 1 ? ', ' : ''));
            }
        }

        return $ret_string;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_perms()
    {
        $arr = array();

        foreach (DB::table('permission_user')->where('user_id',$this->id)->get()->pluck('permission_id') as $perm) {
            $arr[] = $perm;
        }
        return $arr ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function user_images()
    {
        return $this->hasMany(Images::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'company_id');
    }

    /**
     * Return object of user registered companies
     * @var object
     */
    public function userCompanies()
    {
        $res = array();
        $companies =  Company::where('user_id', $this->id)->get();

        if( !empty($companies) ) {
            foreach($companies as $comp) {
                $res[] = $comp;
            }
        }

        $assocCompanies = CompanyUser::where('user_id', $this->id)->get();
        if( !empty($assocCompanies) ){
            foreach($assocCompanies as $comp) {
                if($comp->status == 'verified'){
                    $res[] = Company::findOrFail($comp->company_id);
                }
            }
        }

        return json_decode(json_encode($res));
    }

    /**
     * Display a listing of the resource.
     *
     * @var object
     */
    public function user_gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * Display a listing of the resource.
     *
     * @var object
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Display a listing of the resource.
     *
     * @var object
     */
    public function categorySections() {
        $userCatSecs = array();

        foreach ($this->getRoles() as $value) {
            $name = Role::where( 'name', $value )->first()->display_name;
            $roles[] = $name ?? '';

            foreach (CategorySection::all() as $sec) {
                if( in_array($value, explode(',', $sec->roles)) ){
                    if (!in_array($sec, $userCatSecs)) {
                        $userCatSecs[] = $sec;
                    }
                }
            }
        }

        return $userCatSecs;
    }
}

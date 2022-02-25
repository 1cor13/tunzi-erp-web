<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InsurancePartner;
use App\Models\PartnerService;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id', 'country_id', 'district_id', 'gallery_id', 'major_partner', 'partner_id', 'partner_type', 
    	'alt_phone', 'open_hours', 'gps_lat', 'gps_long', 'category', 'status'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partners';
    
    /**
     * Has many to relationship 
     *
     */
    public function insurancePartners()
    {
        return $this->hasMany(InsurancePartner::class);
    }
    
    /**
     * has many to relationship 
     *
     */
    public function partnerServices()
    {
        return $this->hasMany(PartnerService::class);
    }
}

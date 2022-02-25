<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insurance;
use App\Models\Partner;

class InsurancePartner extends Model
{
    use HasFactory;

    protected $fillable = [
    	'insurance_id', 'partner_id', 'description', 'status'
    ];

    protected $table = 'insurance_partners';
    
    /**
     * Belonds to relationship 
     *
     */
    public function partners()
    {
        return $this->belongsTo(Partner::class);
    }
    
    /**
     * Belonds to relationship 
     *
     */
    public function insurances()
    {
        return $this->belongsTo(Insurance::class);
    }
}

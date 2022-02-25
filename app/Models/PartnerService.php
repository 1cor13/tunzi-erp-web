<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerService extends Model
{
    use HasFactory;

    protected $fillable = [
    	'partner_id', 'service_id', 'service_tasks', 'previous_price', 'current_price', 'price_visibility', 'price_end_date', 'time_available', 'status'
    ];

    protected $table = 'partner_services';
}

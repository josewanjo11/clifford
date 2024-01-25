<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;
use App\Models\travel_agents;

class bookings extends Model
{
    use HasFactory;
    protected $fillable=['rates','clientName','clientEmail','clientPhone','clientAddress','rooms','checkInDate','checkOutDate','accommodation_id','travel_agent_id','totals','status'];

    public function accommodation()
    {
        return $this->belongsTo(accommodations::class);
    }

    public function travelAgent()
    {
        return $this->belongsTo(travel_agents::class);
    }
}

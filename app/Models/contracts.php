<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;
use App\Models\travel_agents;
class contracts extends Model
{
    use HasFactory;
    protected $fillable=['contract_rate','start_date','end_date','accommodation_id','travel_agent_id'];
    public function accommodation()
    {
        return $this->belongsTo(accommodations::class);
    }

    public function travelAgent()
    {
        return $this->belongsTo(travel_agents::class);
    }
}

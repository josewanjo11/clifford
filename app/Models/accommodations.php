<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accommodations extends Model
{
    use HasFactory;
    protected $fillable=['name','description','standard_rack_rate'];
}

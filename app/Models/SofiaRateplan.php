<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SofiaRateplan extends Model
{
    use HasFactory;
    protected $table = 'sofia_rateplan';
    protected $fillable = [
        'plan_name',
        'cc',
        'max_call_length',
        'status',
        'created_at'
    ]; 
}

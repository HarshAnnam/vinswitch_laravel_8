<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Did extends Model
{
    use HasFactory;
    protected $table = 'did';
    protected $fillable = [
        'number',
        'account_number',
        'order_no',
        'type',
        'route_sip_id',
        'did_type',
        'rate_center',
        'status',
        'price',
        'vendor_id',
        'e911',
        'sms',
        'activated_date',
        'release_date',
        'created_at'

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $table = "tenant"; 

    protected $fillable = [
        'account_number',
        'agent_id',
        'billpan_id',        
        'join_date',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'balance',
        'unbilled_balance',
        'effective_balance',
        'monthly_mins',
        'additional_mins',
        'company_name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'status',
        'suspended',
        'suspend_date',
        'suspend_reason',
        'reactivate_date',
        'updated_at',
        'created_at'
    ];
}

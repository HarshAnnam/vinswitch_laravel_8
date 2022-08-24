<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentBillplan extends Model
{
    use HasFactory;
    protected $table = 'agent_billplan';
    protected $fillable = [
        'agent_id',
        'billplan_id',
        'commission',
        'status',        
    ];
}

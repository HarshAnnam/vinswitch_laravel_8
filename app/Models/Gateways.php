<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateways extends Model
{
    use HasFactory;
    protected $table = 'gateways';
    protected $fillable = [
        'gateway_name',
        'prefix',
        'username',
        'password',
        'auth_username',
        'realm',
        'from_user',
        'from_domain',
        'proxy',
        'register_proxy',
        'outbound_proxy',
        'expire_seconds',
        'register',
        'retry_seconds',
        'ping',
        'caller_id_in_from',
        'channels',
        'profile',
        'hostname',
        'outbound_default',
        'updated_at',
        'created_at',
        'modified_at'
    ]; 
}

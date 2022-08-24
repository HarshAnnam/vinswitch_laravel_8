<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acl extends Model
{
    use HasFactory;
    protected $table = 'acl_nodes';
    protected $fillable = [
        'cidr',
        'type',
        'list_id',
        'is_endpoint'
    ];
}

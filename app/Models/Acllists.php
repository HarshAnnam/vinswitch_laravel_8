<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acllists extends Model
{
    use HasFactory;
    protected $table = 'acl_lists';
    protected $fillable = [
        'acl_name',
        'default_policy'
    ];
}

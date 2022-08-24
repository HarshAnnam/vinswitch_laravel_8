<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table="vendor";
    protected $fillable = [
        'vendor_name',
        'vendor_code',
        'did_type',
        'status',
        'priority',
        'created_at'
    ];
}

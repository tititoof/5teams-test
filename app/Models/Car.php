<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'variant',
        'license_plate',
        'fuel_type',
        'price',
        'sales_type',
        'reserved',
    ];

    protected $casts = [
        'reserved' => 'boolean',
    ];
}
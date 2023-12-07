<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    use HasFactory;
    protected $table = 'order_images';

    protected $fillable = [
        'orders_id',
        'image',
        'finalimage'
    ];

}

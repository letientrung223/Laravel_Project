<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_user',
        'name',
        'price',
        'id_category',
        'brand_name',
        'status',
        'sale',
        'company',
        'images',
        'detail',
        'image',
        

    ];
}

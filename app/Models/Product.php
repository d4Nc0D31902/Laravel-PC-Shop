<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $primaryKey = 'product_id';
    protected $guarded = ['product_id'];
    // public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'brand',
        'type',
        'imagePath',
    ];
}

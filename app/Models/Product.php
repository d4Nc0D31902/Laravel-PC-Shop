<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
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

    public function toSearchableArray()
    {
        return [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}

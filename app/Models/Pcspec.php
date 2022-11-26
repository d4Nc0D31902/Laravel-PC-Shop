<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pcspec extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'pcspecs';
    public $primaryKey = 'pc_id';
    protected $guarded = ['pc_id', 'imagePath'];
    
    protected $fillable = [
        'customer_id',
        'cpu',
        'motherboard',
        'gpu',
        'ram',
        'hdd',
        'sdd',
        'psu',
        'pc_case',
        'imagePath',
    ];
}

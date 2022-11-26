<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'customers';
    public $primaryKey = 'customer_id';
    protected $guarded = ['customer_id', 'imagePath'];
    // public $timestamps = false;
    
    protected $fillable = [
        'title',
        'fname',
        'lname',
        'addressline',
        'town',
        'zipcode',
        'phone',
        'imagePath',
        'user_id',
    ];
    
    public function users() {
        return $this->belongsTo('App\Models\User');
    }

}

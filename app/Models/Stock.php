<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $table = 'stock';
	public $timestamps = false;
	protected $fillable = [
        'quantity',
        'product_id'];
	
	public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }

}